<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tanaman;
use Illuminate\Http\Request;

class TanamanController extends Controller
{
    /**
     * Menampilkan daftar semua tanaman (katalog).
     */
    public function index()
    {
        $tanaman = Tanaman::latest()->get();
        return view('admin.tanaman.index', compact('tanaman'));
    }

    /**
     * Menampilkan form untuk membuat tanaman baru.
     */
    public function create()
    {
        return view('admin.tanaman.create');
    }

    /**
     * Menyimpan data tanaman baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'cara_tanam' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Untuk validasi upload gambar
            'ph_min' => 'required|numeric|min:0|max:14',
            'ph_max' => 'required|numeric|min:0|max:14',
            'intensitas_sinar_matahari' => 'required|in:rendah,sedang,tinggi,rendah_sedang,sedang_tinggi,semua',
            'kelembaban_tanah' => 'required|in:rendah,sedang,tinggi,rendah_sedang,sedang_tinggi,semua',
            'drainase_tanah' => 'required|in:baik,sedang,buruk,baik_sedang,semua',
            'jenis_tanah' => 'required|string|max:255',
            'ketinggian_mdpl_min' => 'nullable|integer|min:0',
            'ketinggian_mdpl_max' => 'nullable|integer|min:0',
        ]);

        $data = $request->except('gambar'); // Ambil semua data kecuali gambar

        if ($request->hasFile('gambar')) {
            $imagePath = $request->file('gambar')->store('tanaman_images', 'public');
            $data['gambar'] = $imagePath;
        }

        Tanaman::create($data);

        return redirect()->route('admin.tanaman.index')->with('success', 'Tanaman berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail tanaman tertentu.
     */
    public function show(Tanaman $tanaman)
    {
        return view('admin.tanaman.show', compact('tanaman'));
    }

    /**
     * Menampilkan form untuk mengedit tanaman.
     */
    public function edit(Tanaman $tanaman)
    {
        return view('admin.tanaman.edit', compact('tanaman'));
    }

    /**
     * Mengupdate data tanaman di database.
     */
    public function update(Request $request, Tanaman $tanaman)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'cara_tanam' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Untuk validasi upload gambar
            'ph_min' => 'required|numeric|min:0|max:14',
            'ph_max' => 'required|numeric|min:0|max:14',
            'intensitas_sinar_matahari' => 'required|in:rendah,sedang,tinggi,rendah_sedang,sedang_tinggi,semua',
            'kelembaban_tanah' => 'required|in:rendah,sedang,tinggi,rendah_sedang,sedang_tinggi,semua',
            'drainase_tanah' => 'required|in:baik,sedang,buruk,baik_sedang,semua',
            'jenis_tanah' => 'required|string|max:255',
            'ketinggian_mdpl_min' => 'nullable|integer|min:0',
            'ketinggian_mdpl_max' => 'nullable|integer|min:0',
        ]);

        $data = $request->except('gambar');

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($tanaman->gambar) {
                \Storage::disk('public')->delete($tanaman->gambar);
            }
            $imagePath = $request->file('gambar')->store('tanaman_images', 'public');
            $data['gambar'] = $imagePath;
        }

        $tanaman->update($data);

        return redirect()->route('admin.tanaman.index')->with('success', 'Tanaman berhasil diupdate!');
    }

    /**
     * Menghapus data tanaman dari database.
     */
    public function destroy(Tanaman $tanaman)
    {
        // Hapus gambar terkait jika ada
        if ($tanaman->gambar) {
            \Storage::disk('public')->delete($tanaman->gambar);
        }
        $tanaman->delete();
        return redirect()->route('admin.tanaman.index')->with('success', 'Tanaman berhasil dihapus!');
    }
}