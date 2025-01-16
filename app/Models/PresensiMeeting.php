<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresensiMeeting extends Model
{
    use HasFactory;

    /*Menentukan tabel yang dapat diisi secara massal */
    protected $fillable = [
        'meeting_id',
        'siswa_id',
        'status',
    ];

    /*relasi dengan model Meeting */
    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }

    /*relasi dengan model Siswa */
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
