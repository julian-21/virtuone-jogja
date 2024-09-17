<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
{
    if (auth()->user()->role == 'ADMIN') {
        // Logika untuk aksi ADMIN
        return view('layouts/home'); // Contoh: tampilkan tampilan khusus untuk ADMIN
    } elseif (auth()->user()->role == 'PETUGAS') {
        // Logika untuk aksi PETUGAS
        return view('layouts/home'); // Contoh: tampilkan tampilan khusus untuk PETUGAS
    }

    // Logika default jika peran tidak cocok
    return view('layouts/home');
}

}
