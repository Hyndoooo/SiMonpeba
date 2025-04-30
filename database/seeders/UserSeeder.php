<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Guru;
use App\Models\DataSiswa;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Data guru yang akan diinput
        $gurus = [
            [
                'username' => 'hyndoooo',
                'email' => 'muhammadaldofirdaus173@gmail.com',
                'password' => 'admin123',
                'role' => 'guru',
                'nama' => 'Muhammad Aldo Firdaus',
                'alamat' => 'Sindang, Indramayu',
                'no_telepon' => '089664237779',
                'nip' => '2305044', 
                'foto_profil' => 'uploads/foto_guru/guru1.jpg',
            ],
            [
                'username' => 'bttrfly',
                'email' => 'sitinuralisah1211@gmail.com',
                'password' => 'admin123',
                'role' => 'guru',
                'nama' => 'Siti Nuralisah',
                'alamat' => 'Bangkir, Indamayu',
                'no_telepon' => '083167112392',
                'nip' => '2305045',
                'foto_profil' => 'uploads/foto_guru/guru2.jpg',
            ],
            [
                'username' => 'dullf',
                'email' => 'abdulfajarr04@gmail.com',
                'password' => 'admin123',
                'role' => 'guru',
                'nama' => 'Mohammad Abdul Fajar',
                'alamat' => 'Karangsong, Indramayu',
                'no_telepon' => '0895423291406',
                'nip' => '2305046',
                'foto_profil' => 'uploads/foto_guru/guru3.jpg',
            ],
            [
                'username' => 'fzlnfm',
                'email' => 'fazlinurfahmi92@gmail.com',
                'password' => 'admin123',
                'role' => 'guru',
                'nama' => 'Muhammad Fazli Nurfahmi',
                'alamat' => 'Krangkeng, Indramayu',
                'no_telepon' => '089678716425',
                'nip' => '2305047',
                'foto_profil' => 'uploads/foto_guru/guru4.jpg',
            ],
            [
                'username' => 'sgrhen',
                'email' => 'teamsgrhen@gmail.com',
                'password' => 'admin123',
                'role' => 'guru',
                'nama' => 'Hendri Paturaya',
                'alamat' => 'Segeran, Indramayu',
                'no_telepon' => '083195754705',
                'nip' => '2305048',
                'foto_profil' => 'uploads/foto_guru/guru5.jpg',
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

        // Data orang tua yang akan diinput
        $ortuData = [
            [
                'username' => 'muhammadaldo17122023',
                'email' => 'viviwulanseptiani@gmail.com',
                'password' => 'password123',
                'role' => 'ortu',
                'nama' => 'Muhammad Aldo',
                'ttl' => '2023-12-17',
                'agama' => 'Islam',
                'alamat' => 'Jl. Mangga, Jakarta',
                'orangtua_wali' => 'Ahmad Sudirman',
                'no_telepon' => '089664237779',
                'kelas' => 'TK A',
                'foto_profil' => 'uploads/foto_siswa/siswa1.jpg',
                'nis' => '2305010',
            ],
            [
                'username' => 'muhammadfazlinurfahmi12022023',
                'email' => 'fazli@gmail.com',
                'password' => 'password123',
                'role' => 'ortu',
                'nama' => 'Muhammad Fazli Nurfahmi',
                'ttl' => '2023-03-12',
                'agama' => 'Islam',
                'alamat' => 'Jl. Melati, Bandung',
                'orangtua_wali' => 'Siti Aminah',
                'no_telepon' => '081234567891',
                'kelas' => 'TK B',
                'foto_profil' => 'uploads/foto_siswa/siswa2.jpg',
                'nis' => '2305011',
            ],
            [
                'username' => 'mohammadabdulfajar17122003',
                'email' => 'fajar@gmail.com',
                'password' => 'password123',
                'role' => 'ortu',
                'nama' => 'Mohammad Abdul Fajar',
                'ttl' => '2023-12-17',
                'agama' => 'Islam',
                'alamat' => 'Jl. Mangga, Jakarta',
                'orangtua_wali' => 'Ahmad Rifai',
                'no_telepon' => '089',
                'kelas' => 'TK A',
                'foto_profil' => 'uploads/foto_siswa/siswa3.jpg',
                'nis' => '2305012',
            ],
            [
                'username' => 'sitinuralisah11122003',
                'email' => 'sitinuralisah1112@gmail.com',
                'password' => 'password123',
                'role' => 'ortu',
                'nama' => 'Siti Nuralisah',
                'ttl' => '2003-12-11',
                'agama' => 'Islam',
                'alamat' => 'Jl. Melati, Bandung',
                'orangtua_wali' => 'Siti Aminah',
                'no_telepon' => '081',
                'kelas' => 'TK B',
                'foto_profil' => 'uploads/foto_siswa/siswa4.jpg',
                'nis' => '2305013',
            ],
            [
                'username' => 'bimafatuchman17122003',
                'email' => 'biima.ftr@gmail.com',
                'password' => 'password123',
                'role' => 'ortu',
                'nama' => 'Bima Fatuchmani',
                'ttl' => '2023-12-17',
                'agama' => 'Islam',
                'alamat' => 'Jl. Mangga, Jakarta',
                'orangtua_wali' => 'Ahmad Sudirman',
                'no_telepon' => '085',
                'kelas' => 'TK A',
                'foto_profil' => 'uploads/foto_siswa/siswa5.jpg',
                'nis' => '2305014',
            ],
            
        ];

        foreach ($ortuData as $ortu) {
            // Membuat entri pada tabel users
            $user = User::firstOrCreate([
                'username' => $ortu['username'],
                'email' => $ortu['email']
            ], [
                'password' => Hash::make($ortu['password']),
                'role' => $ortu['role'],
            ]);

            // Membuat entri pada tabel data_siswa
            DataSiswa::firstOrCreate([
                'nis' => $ortu['nis'],
                'id' => $user->id, // Relasi ke tabel users
            ], [
                'nama' => $ortu['nama'],
                'ttl' => $ortu['ttl'],
                'agama' => $ortu['agama'],
                'alamat' => $ortu['alamat'],
                'orangtua_wali' => $ortu['orangtua_wali'],
                'no_telepon' => $ortu['no_telepon'],
                'kelas' => $ortu['kelas'],
                'foto_profil' => $ortu['foto_profil'],
            ]);
        }
    }
}
