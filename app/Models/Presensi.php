<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    protected $table = 'presensi';

    protected $fillable = [
        'tanggal_masuk', 'jam_masuk', 'foto_masuk', 'tanggal_keluar', 'jam_keluar', 'foto_keluar', 'karyawan_id', 'lokasi_presensi_id'
    ];
}
