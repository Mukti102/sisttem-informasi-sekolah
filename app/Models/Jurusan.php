<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/*Mendefenisikan kelas jurusan */
class Jurusan extends Model
{
    use HasFactory;
    /*Menentukan nama tabel */
    protected $table = 'jurusans';

    /*Menentukan atribut yang diisi secara massal */
    protected $fillable = [
        'nama_jurusan',
    ];



    /*Relasi mapel */
    public function mapel()
    {
        return $this->hasMany(Mapel::class);
    }
}
