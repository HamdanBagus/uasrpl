<?php

namespace App\Http\Controllers;

use App\Models\Tanaman;
use Illuminate\Http\Request; // Pastikan Request di-import

class TanamanKatalogController extends Controller
{
    /**
     * Menampilkan daftar semua tanaman untuk user biasa (katalog publik) dengan fitur pencarian.
     */
    public function index(Request $request) // Tambahkan parameter Request $request
    {
        $query = Tanaman::orderBy('nama'); // Ini adalah query dasar untuk mengambil semua tanaman

        // Periksa apakah ada parameter 'search' di URL dan tidak kosong
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search; // Ambil nilai pencarian
            $query->where(function($q) use ($searchTerm) {
                // Cari di kolom 'nama', 'deskripsi', atau 'jenis_tanah'
                $q->where('nama', 'like', '%' . $searchTerm . '%')
                  ->orWhere('deskripsi', 'like', '%' . $searchTerm . '%')
                  ->orWhere('jenis_tanah', 'like', '%' . $searchTerm . '%');
            });
        }

        $tanaman = $query->get(); // Jalankan query dan ambil hasilnya

        return view('katalog.index', compact('tanaman'));
    }

    /**
     * Menampilkan detail satu tanaman untuk user biasa.
     */
    public function show(Tanaman $tanaman)
    {
        return view('katalog.show', compact('tanaman'));
    }
}