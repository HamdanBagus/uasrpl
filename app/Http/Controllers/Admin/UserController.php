<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User; // Pastikan model User di-import
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Menampilkan daftar semua pengguna.
     */
    public function index()
    {
        // Ambil semua pengguna kecuali yang memiliki peran 'admin' (opsional, jika admin tidak ingin melihat dirinya di daftar ini)
        $users = User::where('role', 'user')->orderBy('name')->get();

        return view('admin.users.index', compact('users'));
    }

    // Anda bisa menambahkan method lain seperti 'edit', 'update', 'destroy' nanti
}