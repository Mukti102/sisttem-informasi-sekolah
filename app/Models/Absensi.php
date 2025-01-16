<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/*
|*Fungsi untuk mengelola data  absensi, termasuk dengan relasi dengan model lain.
|* Model ini dapat melakukan operasi CRUD (Create, Read, Update, Delete) pada data absensi.
| 
|
*
*/

/*Mendefenisikan kelas absensi untuk tabel absensi */
class Absensi extends Model
{
    /*Menggunakan trait HasFactory untuk memudahkan proses penggunaan factory */
    use HasFactory;

    /*Menentukan atribut yang dapat diisi secara massal */
    protected $fillable = [
        'kelas_id',
        'guru_id'
    ];

    /*Menonaktidfkan timestamp pada tabel absensi */
    public $timestamps = false;
    /*Menentukan nama tabel absensi */
    protected $table = 'absensis';

    /*Mendefenisikan relasi antara model absensi dan model kelas */
    public function kelas()
    {
        /*Setiap entri absensi memiliki kelas yang terkait */
        return $this->belongsTo(Kelas::class);
    }

    /*Mendefenisikan relasi antara model absensi dan model guru */
    public function guru()
    {
        /*Setiap entri absensi memiliki guru yang terkait */
        return $this->belongsTo(Guru::class);
    }

    /*Mendefenisikan relasi antara model absensi dan model meeting */
    public function meetings()
    {
        /*Setiap entri absensi memiliki meeting yang terkait */
        return $this->hasMany(Meeting::class);
    }
}
