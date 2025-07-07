<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table = 'karyawan';

    protected $fillable = [
        'nip', 'name', 'jenis_kelamin', 'alamat', 'no_hp', 'jabatan', 'lokasi_presensi', 'foto'
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
