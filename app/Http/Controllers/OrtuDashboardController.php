<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DataSiswa;

class OrtuDashboardController extends Controller
{
    public function index()
    {
        // Ambil data siswa berdasarkan ID user yang login
        $userId = Auth::id(); // ID dari tabel users
        $siswa = DataSiswa::where('id', $userId)->first();

        if (!$siswa) {
            // Jika data siswa tidak ditemukan, tampilkan pesan atau halaman lain
            return redirect()->route('ortu.dashboard')->withErrors('Data siswa tidak ditemukan.');
        }

        return view('ortu.dashboard', compact('siswa'));
    }
}
