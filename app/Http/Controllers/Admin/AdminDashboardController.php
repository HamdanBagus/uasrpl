<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tanaman;
use App\Models\User; // Pastikan model User di-import
use App\Models\Lahan; // Pastikan model Lahan di-import

class AdminDashboardController extends Controller
{
    /**
     * Menampilkan dashboard untuk admin.
     */
    public function index()
    {
        $user = Auth::user();
        $jumlahTanaman = Tanaman::count(); // Menghitung jumlah total tanaman di katalog
        $jumlahPengguna = User::where('role', 'user')->count(); // Menghitung jumlah user biasa
        $jumlahSemuaLahan = Lahan::count(); // Menghitung jumlah total data lahan dari semua user

        return view('admin.dashboard', compact('user', 'jumlahTanaman', 'jumlahPengguna', 'jumlahSemuaLahan'));
    }
}