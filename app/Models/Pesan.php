<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    use HasFactory;

    protected $table = 'pesan';
    protected $primaryKey = 'id_pesan';

    protected $fillable = [
        'id_pengirim', 'id_penerima', 'pesan', 'waktu_kirim'
    ];

    /**
     * Relasi ke User yang mengirim pesan.
     */
    public function pengirim()
    {
        return $this->belongsTo(User::class, 'id_pengirim', 'id');
    }

    /**
     * Relasi ke User yang menerima pesan.
     */
    public function penerima()
    {
        return $this->belongsTo(User::class, 'id_penerima', 'id');
    }
}
