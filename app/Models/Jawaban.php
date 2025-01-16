<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    use HasFactory;

    /*Menentukan atribut yang dapat diisi secara massal */
    protected $fillable = ['tugas_id', 'siswa_id', 'jawaban', 'file'];

    //relasi tugas
    public function tugas() {
        return $this->belongsTo(Tugas::class);
    }

    //relasi siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
