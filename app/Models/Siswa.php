<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    /*Menentukan tabel yang dapat diisi dengan massal */
    protected $fillable = ['nis', 'nama', 'kelas_id', 'telp', 'alamat', 'foto'];

    /*relasi dengan model kelas */
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }

    /*relasi dengan model presensi */
    public function presensi()
    {
        return $this->hasMany(PresensiMeeting::class, 'siswa_id', 'id');
    }

   
    
    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'kelas_id', 'kelas_id');
    }
}