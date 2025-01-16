<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    /*Menentukan tabel yang dapat diisi secara massal */
    protected $fillable = ['nama_mapel', 'jurusan_id'];

    /*Relasi guru dan mapel */
    public function jurusan()
    {
        /*Mengembalikan relasi ke model guru */
        return $this->belongsTo(Jurusan::class);


        /*Relasi mapel dan kelas */
    }
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'mapel_id', 'id');
    }
}
