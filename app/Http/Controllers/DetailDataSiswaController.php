<?php

namespace App\Http\Controllers;

use App\Models\DataSiswa;

class DetailDataSiswaController extends Controller
{
    public function index($nis)
    {
        // Cari data siswa berdasarkan NIS
        $siswa = DataSiswa::where('nis', $nis)->firstOrFail();

        // Kirim data ke view
        return view('data_siswa.detail', compact('siswa'));
    }
}

