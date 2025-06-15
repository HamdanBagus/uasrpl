<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Lahan; // Pastikan model Lahan di-import

class UserDashboardController extends Controller
{
    /**
     * Menampilkan dashboard untuk user biasa.
     */
    public function index()
    {
        $user = Auth::user();
        $jumlahLahan = $user->lahans()->count(); // Menghitung jumlah data lahan user

        // Anda bisa tambahkan data lain di sini jika diperlukan,
        // contoh: jumlah rekomendasi terbaru, dll.

        return view('dashboard', compact('user', 'jumlahLahan'));
    }
}
