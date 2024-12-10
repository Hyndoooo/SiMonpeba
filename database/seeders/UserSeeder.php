<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Guru;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Data guru yang akan diinput
        $gurus = [
            [
                'username' => 'hyndoooo',
                'email' => 'muhammadaldofirdaus@gmail.com',
                'password' => 'Lisacantik66',
                'role' => 'guru',
                'nama' => 'Muhammad Aldo Firdaus',
                'alamat' => 'Sindang, Indramayu',
                'no_telepon' => '089664237779',
                'nip' => '2305044',
                'foto_profil' => 'hyndoooo.jpg',
            ],
            [
                'username' => 'bttrfly',
                'email' => 'bttrfly@gmail.com',
                'password' => 'Lisacantik66',
                'role' => 'guru',
                'nama' => 'Siti Nuralisah',
                'alamat' => 'Bangkir, Indamayu',
                'no_telepon' => '083167112392',
                'nip' => '2305045',
                'foto_profil' => 'bttrfly.jpg',
            ],
            [
                'username' => 'dullf',
                'email' => 'dullf@gmail.com',
                'password' => 'Lisacantik66',
                'role' => 'guru',
                'nama' => 'Mohammad Abdul Fajar',
                'alamat' => 'Karangsong, Indramayu',
                'no_telepon' => '0895423291406',
                'nip' => '2305046',
                'foto_profil' => 'dullf.jpg',
            ],
            [
                'username' => 'fzlnfm',
                'email' => 'fzlnfm@gmail.com',
                'password' => 'Lisacantik66',
                'role' => 'guru',
                'nama' => 'Muhammad Fazli Nurfahmi',
                'alamat' => 'Krangkeng, Indramayu',
                'no_telepon' => '089678716425',
                'nip' => '2305047',
                'foto_profil' => 'fzlnfm.jpg',
            ],
            [
                'username' => 'sgrhen',
                'email' => 'sgrhen@gmail.com',
                'password' => 'password123',
                'role' => 'guru',
                'nama' => 'Hendri Paturaya',
                'alamat' => 'Segeran, Indramayu',
                'no_telepon' => '083195754705',
                'nip' => '2305048',
                'foto_profil' => 'sgrhen.jpg',
            ],
        ];

        foreach ($gurus as $guru) {
            // Membuat entri pada tabel users jika username dan email tidak ada
            $user = User::firstOrCreate([
                'username' => $guru['username'],
                'email' => $guru['email']
            ], [
                'password' => Hash::make($guru['password']),
                'role' => $guru['role'],
            ]);

            // Membuat entri pada tabel guru yang terkait, jika belum ada
            Guru::firstOrCreate([
                'nip' => $guru['nip'],
                'id' => $user->id, // Relasi ke tabel users
            ], [
                'nama' => $guru['nama'],
                'alamat' => $guru['alamat'],
                'no_telepon' => $guru['no_telepon'],
                'foto_profil' => $guru['foto_profil'],
            ]);
        }
    }
}
