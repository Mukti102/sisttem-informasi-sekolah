<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    /*Menentukan tabel yang dapat diisi secara massal */
    protected $fillable = ['kelas_id', 'guru_id', 'siswa_id', 'nilai_harian', 'nilai_uts','tugas_id', 'nilai','kkm'];

    /*Relasi model nilai dan kelas */
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    /*relasi model nilai dan guru */
    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    /* Relasi model nilai dan siswa */
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    
}
