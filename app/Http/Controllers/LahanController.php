<?php

namespace App\Http\Controllers;

use App\Models\Lahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Tambahkan ini

class LahanController extends Controller
{
    /**
     * Menampilkan daftar lahan yang dimiliki user saat ini.
     */
    public function index()
    {
        $lahans = Auth::user()->lahans()->latest()->get();
        return view('lahans.index', compact('lahans'));
    }

    /**
     * Menampilkan form untuk membuat lahan baru.
     */
    public function create()
    {
        return view('lahans.create');
    }

    /**
     * Menyimpan data lahan baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lahan' => 'required|string|max:255',
            'ph_tanah' => 'required|numeric|min:0|max:14',
            'intensitas_sinar_matahari' => 'required|in:rendah,sedang,tinggi',
            'kelembaban_tanah' => 'required|in:rendah,sedang,tinggi',
            'drainase_tanah' => 'required|in:baik,sedang,buruk',
            'jenis_tanah' => 'required|string|max:255',
            'luas_lahan' => 'nullable|numeric|min:0',
            'ketinggian_mdpl' => 'nullable|integer|min:0',
        ]);

        Auth::user()->lahans()->create($request->all());

        return redirect()->route('lahans.index')->with('success', 'Data lahan berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail lahan tertentu.
     */
    public function show(Lahan $lahan)
    {
        // Pastikan user hanya bisa melihat lahannya sendiri
        if ($lahan->user_id !== Auth::id()) {
            abort(403); // Forbidden
        }
        return view('lahans.show', compact('lahan'));
    }

    /**
     * Menampilkan form untuk mengedit lahan.
     */
    public function edit(Lahan $lahan)
    {
         if ($lahan->user_id !== Auth::id()) {
            abort(403);
        }
        return view('lahans.edit', compact('lahan'));
    }

    /**
     * Mengupdate data lahan di database.
     */
    public function update(Request $request, Lahan $lahan)
    {
         if ($lahan->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'nama_lahan' => 'required|string|max:255',
            'ph_tanah' => 'required|numeric|min:0|max:14',
            'intensitas_sinar_matahari' => 'required|in:rendah,sedang,tinggi',
            'kelembaban_tanah' => 'required|in:rendah,sedang,tinggi',
            'drainase_tanah' => 'required|in:baik,sedang,buruk',
            'jenis_tanah' => 'required|string|max:255',
            'luas_lahan' => 'nullable|numeric|min:0',
            'ketinggian_mdpl' => 'nullable|integer|min:0',
        ]);

        $lahan->update($request->all());

        return redirect()->route('lahans.index')->with('success', 'Data lahan berhasil diupdate!');
    }

    /**
     * Menghapus data lahan dari database.
     */
    public function destroy(Lahan $lahan)
    {
        if ($lahan->user_id !== Auth::id()) {
            abort(403);
        }
        $lahan->delete();
        return redirect()->route('lahans.index')->with('success', 'Data lahan berhasil dihapus!');
    }
}