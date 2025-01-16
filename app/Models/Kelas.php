<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    /*Menentukan tabel yang dapat diisi secara massal */
    protected $fillable = ['nama_kelas', 'guru_id', 'jurusan_id'];

    /*Relasi antar mode kelas dan guru */
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }
}