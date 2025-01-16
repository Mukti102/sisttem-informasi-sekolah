<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Meeting extends Model
{
    use HasFactory;


    /*Menentukan tabel yang dapat diisi massal*/
    protected $fillable = [
        'id',
        'absensi_id',
        'pertemuan_ke'
    ];


    /*rekasi model absensi dan model meeting */
    public function absensi()
    {
        return $this->belongsTo(Absensi::class);
    }

    /*relasi model absensi dan model meeting */
    public function presensi()
    {
        return $this->hasMany(PresensiMeeting::class, 'meeting_id');
    }
}
