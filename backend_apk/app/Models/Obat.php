<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    protected $table = 'obat';

    protected $fillable = [
        'nama_obat',
        'jenis_obat',
        'harga',
        'stok',
        'keterangan'
    ];
}
