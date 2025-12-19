<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $table = 'dokter';

    protected $fillable = [
        'nama',
        'spesialis',
        'gender',
        'email',
        'alamat'
    ];

    public function kunjungan()
    {
        return $this->hasMany(RiwayatKunjungan::class);
    }
}
