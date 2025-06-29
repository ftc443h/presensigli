<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ketidakhadiran extends Model
{
    protected $table = 'ketidakhadiran';

    protected $fillable = [
        'keterangan', 'tanggal', 'deskripsi', 'file', 'status_pengajuan', 'karyawan_id',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }
}
