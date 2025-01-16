<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;
    /*Menentukan nama tabel yang digunakan*/
    protected $fillable = ['judul', 'deskripsi', 'file', 'guru_id', 'kelas_id'];

    /*Relasi model guru dan model materi */
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    /*Relasi model kelas dan model materi */
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
}
