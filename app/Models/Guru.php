<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model ini merepresentasikan entitas guru dalam web.
 * Model ini berfungsi untuk tabel guru dalam database
 * 
 * 
 */
class Guru extends Model
{
    use HasFactory;

    /*Menentukan atribut yang dapat diisi secara massal */
    protected $fillable = ['nip', 'nama', 'mapel_id', 'no_telp', 'alamat', 'foto'];

    /*Setiap guru memiliki satu mata pelajaran yang akan diajarkan */
    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel_id');
    }

    /*relasi nilai */
    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }

    /*relasi kelas */
    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }
}
