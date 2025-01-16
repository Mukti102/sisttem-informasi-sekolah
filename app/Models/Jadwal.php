<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    /*Menggunakan trait HasFactory untuk menggunakan fitur factory di Laravel*/
    use HasFactory;

    /*Menentukan atribut yang dapat diisi secara massal */
    protected $fillable = [
        'mapel_id', 'kelas_id', 'hari', 'dari_jam', 'sampai_jam'
    ];

    /*relasi mapel */
    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel_id', 'id');
    }

    /*Relasi kelas */
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }
}
