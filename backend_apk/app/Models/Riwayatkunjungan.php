<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Riwayatkunjungan extends Model
{
    protected $table = 'riwayat_kunjungan';

    protected $fillable = [
        'pasien_id',
        'dokter_id',
        'tanggal_kunjungan',
        'keluhan',
        'diagnosis',
        'tindakan',
        'resep'
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }
}
