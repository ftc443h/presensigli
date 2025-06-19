<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LokasiPresensi extends Model
{

    protected $table = 'lokasi_presensi';

    protected $fillable = [
        'nama_lokasi', 'alamat_lokasi', 'latitude', 'longitude', 'radius', 'zona_waktu', 'jam_masuk', 'jam_pulang'
    ];
}
