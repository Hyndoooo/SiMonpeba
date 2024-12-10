<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataSiswa;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DataSiswaController extends Controller
{
    public function create()
    {
        return view('data_siswa.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nis' => 'required|integer|unique:data_siswa,nis',
            'nama' => 'required|string|max:255',
            'ttl' => 'required|date',
            'agama' => 'required|string',
            'alamat' => 'required|string',
            'orangtua_wali' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:15',
            'email' => 'required|email|unique:users,email',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);

        $username = preg_replace('/\s+/', '', strtolower($validated['nama'])) . date('dmY', strtotime($validated['ttl']));

        $user = User::create([
            'username' => $username,
            'email' => $validated['email'],
            'password' => Hash::make('password123'),
            'role' => 'ortu',
        ]);

        $fotoProfilPath = $this->handleFotoUpload($request);

        DataSiswa::create([
            'nis' => $validated['nis'],
            'nama' => $validated['nama'],
            'ttl' => $validated['ttl'],
            'agama' => $validated['agama'],
            'alamat' => $validated['alamat'],
            'orangtua_wali' => $validated['orangtua_wali'],
            'no_telepon' => $validated['no_telepon'],
            'id' => $user->id,
            'foto_profil' => $fotoProfilPath,
        ]);

        return redirect()->route('data_siswa.create')->with('success', 'Data siswa berhasil disimpan.');
    }

    private function handleFotoUpload(Request $request)
    {
        if ($request->hasFile('foto_profil')) {
            $file = $request->file('foto_profil');
            return $file->store('uploads/foto_siswa', 'public');
        }
        return 'images/default.jpg';
    }

    public function update(Request $request, DataSiswa $data_siswa)
    {
        $validated = $request->validate([
            'nis' => 'required|integer|unique:data_siswa,nis,' . $data_siswa->nis,
            'nama' => 'required|string|max:255',
            'ttl' => 'required|date',
            'agama' => 'required|string',
            'alamat' => 'required|string',
            'orangtua_wali' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:15',
            'email' => 'required|email|unique:users,email,' . $data_siswa->user->id,
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);

        // Update email di tabel users
        $data_siswa->user->update([
            'email' => $validated['email'],
        ]);

        // Jika ada foto profil yang diupload
        if ($request->hasFile('foto_profil')) {
            if ($data_siswa->foto_profil && $data_siswa->foto_profil !== 'images/default.jpg') {
                Storage::disk('public')->delete($data_siswa->foto_profil);
            }

            $fotoProfilPath = $this->handleFotoUpload($request);
            $validated['foto_profil'] = $fotoProfilPath;
        }

        // Update data siswa dengan validasi yang sudah diterima
        $data_siswa->update($validated);

        return redirect()->route('data_siswa.edit', $data_siswa->nis)->with('success', 'Data siswa berhasil diperbarui.');
    }

}
