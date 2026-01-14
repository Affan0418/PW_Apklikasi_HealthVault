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
        'keluhan_pasien',
        'diagnosis',
        'tindakan_medis',
        'obat_diberikan',
        'catatan_tambahan'
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id');
    }

    public function dokter()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id');
    }
}
