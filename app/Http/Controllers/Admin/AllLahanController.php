<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lahan; // Pastikan model Lahan di-import
use Illuminate\Http\Request;

class AllLahanController extends Controller
{
    /**
     * Menampilkan daftar semua data lahan dari semua pengguna.
     */
    public function index()
    {
        // Eager load user relationship for displaying user name
        $lahans = Lahan::with('user')->orderBy('created_at', 'desc')->get();

        return view('admin.all_lahans.index', compact('lahans'));
    }
}