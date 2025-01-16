<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiSiswa extends Model
{
    use HasFactory;

    /*Menentukan tabel yang dapat diisi secara massal */
    protected $fillable = [
        'nilai_id',
        'siswa_id',
        'harian',
        'uts',
        'uas'
    ];
}
