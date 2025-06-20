<?php

namespace App\Http\Controllers\Guru;

use Illuminate\Http\Request;
use App\Models\DataSiswa;
use App\Http\Controllers\Controller;

class DetailDataSiswaController extends Controller
{
    public function show($nis)
    {
        // Cari data siswa berdasarkan NIS
        $siswa = DataSiswa::where('nis', $nis)->firstOrFail();

        // Tampilkan view detail data siswa
        return view('data_siswa.detail', compact('siswa'));
    }

    public function update(Request $request, $nis)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'ttl' => 'required|date',
            'agama' => 'required|string|max:50',
            'alamat' => 'required|string|max:255',
            'orangtua_wali' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:15',
            'kelas' => 'required|string|max:50',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Cari data siswa berdasarkan NIS
        $siswa = DataSiswa::where('nis', $nis)->firstOrFail();

        // Handle photo upload
        if ($request->hasFile('foto_profil')) {
            $file = $request->file('foto_profil');
            $filename = $file->store('uploads/foto_siswa', 'public');
            $validatedData['foto_profil'] = $filename;
        } else {
            $validatedData['foto_profil'] = $siswa->foto_profil;
        }

        // Update data siswa
        $siswa->update($validatedData);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('data_siswa.detail', $nis)->with('success', 'Data siswa berhasil diperbarui.');
    }

}


