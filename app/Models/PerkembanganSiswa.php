<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerkembanganSiswa extends Model
{
    use HasFactory;

    protected $table = 'perkembangan_siswa';
    protected $primaryKey = 'id_perkembangan';
    public $incrementing = true;
    protected $keyType = 'int';

    // Kolom yang dapat diisi
    protected $fillable = [
        'id_perkembangan',
        'nis',
        'nama',
        'jadwal_pelajaran',
        'penjelasan_perkembangan',
        'catatan',
        'bukti_media',
        'waktu',
    ];

    // Relasi ke DataSiswa
    public function dataSiswa()
    {
        return $this->belongsTo(DataSiswa::class, 'nis', 'nis');
    }
}
