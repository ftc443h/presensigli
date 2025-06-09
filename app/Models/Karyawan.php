<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table = 'Karyawan';

    protected $fillable = [
        'nip', 'name', 'jenis_kelamin', 'alamat', 'no_hp', 'jabatan', 'foto'
    ];
}
