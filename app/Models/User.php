<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'username',
        'email',
        'password',
        'role', // Guru atau Orang Tua
    ];

    /**
     * Relasi One-to-One ke tabel Guru.
     * Setiap user bisa memiliki satu data guru.
     */
    public function guru()
    {
        return $this->hasOne(Guru::class, 'id', 'id');
    }

    /**
     * Relasi One-to-One ke tabel DataSiswa.
     * Setiap user bisa memiliki satu data siswa.
     */
    public function dataSiswa()
    {
        return $this->hasOne(DataSiswa::class, 'id', 'id');
    }

    /**
     * Relasi One-to-Many untuk pesan yang dikirim oleh user.
     */
    public function pesanDikirim()
    {
        return $this->hasMany(Pesan::class, 'id_pengirim', 'id');
    }

    /**
     * Relasi One-to-Many untuk pesan yang diterima oleh user.
     */
    public function pesanDiterima()
    {
        return $this->hasMany(Pesan::class, 'id_penerima', 'id');
    }
}
