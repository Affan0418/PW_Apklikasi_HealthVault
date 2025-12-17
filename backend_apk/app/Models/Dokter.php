<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $table = 'dokter';

    protected $fillable = [
        'nama',
        'spesialis',
        'email',
        'no_telepon',
        'alamat'
    ];

    public function kunjungan()
    {
        return $this->hasMany(RiwayatKunjungan::class);
    }
}
