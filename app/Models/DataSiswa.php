<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSiswa extends Model
{
    use HasFactory;

    protected $table = 'data_siswa';
    protected $primaryKey = 'nis';
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'nis',
        'id', // Relasi dengan tabel users (user_id)
        'nama',
        'ttl',
        'agama',
        'alamat',
        'orangtua_wali',
        'no_telepon',
        'foto_profil',
    ];

    /**
     * Relasi ke tabel User (One-to-One).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }

    /**
     * Relasi ke tabel PerkembanganSiswa (One-to-Many).
     */
    public function perkembanganSiswa()
    {
        return $this->hasMany(PerkembanganSiswa::class, 'nis', 'nis');
    }
}
