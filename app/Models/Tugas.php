<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;
    /*Menentukan tabel yang dapat diisi secara massal */
    protected $fillable = ['judul', 'deskripsi', 'kelas_id', 'guru_id', 'file'];

    /*relasi dengan model guru */
    public function guru() {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    /*relasi dengan model kelas */
    public function kelas()
    {
         return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    /*relasi dengan model jawaban */
    public function jawaban() {
        return $this->hasMany(Jawaban::class, 'tugas_id');
    }
}
