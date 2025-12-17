<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $table = 'pasien';

    protected $fillable = [
        'nama',
        'tanggal_lahir',
        'gender',
        'email',
        'no_telepon',
        'alamat'
    ];

    public function kunjungan()
    {
        return $this->hasMany(RiwayatKunjungan::class);
    }
}
