<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';

    protected $fillable = [
        'nip',
        'id',
        'nama',
        'alamat',
        'no_telepon',
        'foto_profil',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }
}
