<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth; // Penting: Pastikan ini ada
use App\Models\IdentifikasiResult; // Penting: Pastikan ini ada

class PlantIdentifierController extends Controller
{
    /**
     * Menampilkan formulir untuk mengunggah foto identifikasi tanaman.
     */
    public function index()
    {
        return view('identifikasi.index');
    }

    /**
     * Memproses unggahan foto dan mengirimnya ke Plant.id API untuk identifikasi,
     * lalu menyimpan hasilnya ke database.
     */
    public function identify(Request $request)
    {
        $request->validate([
            'plant_image' => 'required|image|max:5120', // Maks 5MB
        ]);

        $apiKey = env('PLANT_ID_API_KEY');
        if (empty($apiKey)) {
            return back()->with('error', 'Kunci API Plant.id tidak ditemukan. Silakan tambahkan di file .env.');
        }

        $imageFile = $request->file('plant_image');
        // Simpan gambar yang diupload user ke folder 'uploaded_for_identification'
        // dan dapatkan URL publiknya untuk ditampilkan kembali dan disimpan di DB
        $userUploadedImageName = 'identified_plant_' . Str::uuid() . '.' . $imageFile->getClientOriginalExtension();
        $userUploadedImagePath = $imageFile->storeAs('uploaded_for_identification', $userUploadedImageName, 'public');
        $userUploadedImageUrl = Storage::url($userUploadedImagePath);


        // Untuk API Plant.id, kita tetap perlu mengirim gambar sebagai base64
        $imageData = base64_encode(Storage::disk('public')->get($userUploadedImagePath));

        try {
            $response = Http::post('https://api.plant.id/v2/identify', [
                'api_key' => $apiKey,
                'images' => [
                    $imageData,
                ],
                'project' => 'all',
                'organs' => ['leaf', 'flower', 'fruit', 'bark', 'stem'],
                'details' => [
                    'common_names', 'url', 'description', 'wiki_url', 'gbif_id', 'taxonomy', 'rank', 'propagation_methods',
                ],
                'language' => 'id',
                'plant_details' => [
                    'common_names', 'url', 'description', 'taxonomy', 'wiki_url', 'edible_parts', 'propagation_methods', 'watering', 'soil', 'sun_exposure',
                ],
            ]);

            $apiResponse = $response->json();

            if ($response->failed()) {
                Log::error('Plant.id API Error: ' . $response->body());
                // Hapus gambar user jika API gagal
                Storage::disk('public')->delete($userUploadedImagePath);
                return back()->with('error', 'Gagal terhubung dengan layanan identifikasi. Coba lagi nanti. Detail: ' . $response->status());
            }

            if (!isset($apiResponse['suggestions']) || empty($apiResponse['suggestions'])) {
                // Hapus gambar user jika tidak teridentifikasi
                Storage::disk('public')->delete($userUploadedImagePath);
                return back()->with('error', 'Tidak dapat mengidentifikasi tanaman dari foto ini. Coba foto lain atau periksa kualitas gambar.');
            }

            $bestSuggestion = $apiResponse['suggestions'][0];
            $plantName = $bestSuggestion['plant_name'] ?? 'Tidak diketahui';
            $probability = round($bestSuggestion['probability'] * 100, 2);
            $details = $bestSuggestion['plant_details'] ?? [];

            // --- BAGIAN UNTUK MENYIMPAN HASIL KE DATABASE ---
            Auth::user()->identifikasiResults()->create([
                'plant_name' => $plantName,
                'probability' => $probability,
                'uploaded_image_path' => $userUploadedImagePath, // Path relatif dari storage/app/public
                'api_response_details' => $apiResponse, // Simpan respons API lengkap
            ]);
            // --- AKHIR BAGIAN PENYIMPANAN KE DATABASE ---


            return view('identifikasi.results', compact('plantName', 'probability', 'details', 'apiResponse', 'userUploadedImageUrl'));

        } catch (\Exception $e) {
            Log::error('Plant Identifier Controller Error: ' . $e->getMessage());
            // Pastikan gambar dihapus jika ada error di try-catch
            Storage::disk('public')->delete($userUploadedImagePath);
            return back()->with('error', 'Terjadi kesalahan saat memproses permintaan Anda: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan riwayat hasil identifikasi tanaman untuk user yang sedang login.
     */
    public function history()
    {
        $results = Auth::user()->identifikasiResults()->latest()->paginate(10); // Ambil 10 per halaman terbaru
        return view('identifikasi.history', compact('results'));
    }

    /**
     * Menampilkan detail dari hasil identifikasi tertentu.
     */
    public function showHistory(\App\Models\IdentifikasiResult $result) // Gunakan FQCN untuk model
    {
        // Pastikan user hanya bisa melihat hasilnya sendiri
        if ($result->user_id !== Auth::id()) {
            abort(403); // Forbidden
        }
        return view('identifikasi.history_detail', compact('result'));
    }

    /**
     * Menghapus hasil identifikasi.
     */
    public function deleteHistory(\App\Models\IdentifikasiResult $result) // Gunakan FQCN untuk model
    {
        // Pastikan user hanya bisa menghapus hasilnya sendiri
        if ($result->user_id !== Auth::id()) {
            abort(403);
        }

        // Hapus gambar terkait dari storage
        if ($result->uploaded_image_path) {
            Storage::disk('public')->delete($result->uploaded_image_path);
        }

        $result->delete();
        return redirect()->route('identifikasi.history')->with('success', 'Hasil identifikasi berhasil dihapus!');
    }
}