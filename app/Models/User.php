<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * TAtribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */

     /*Menentukan atribut yang dapat diisi secara massal */
    protected $fillable = [
        'name',
        'email',
        'password',
        'roles',
        'nis',
        'nip',
        'kelas_id',
    ];

    /**
     * Menentukan atribut yang harus disembunyikan.
     *
     * @var array<int, string>
     */

     /*Menentukan atribut yang disembunyikan */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Atribut yang harus di-cast ke tipe tertentu.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*Mendapatkan NIP data guru berdasarkan NIP */
    public function guru($id) {
        $guru = Guru::where('nip', $id)->first();
        return $guru;
    }

    /*Mendapatkan data siswa berdasarkan NIS */
    public function siswa($id) {
        /*$siswa = Siswa::where('nis', $id)->first();
        return $siswa;*/
         return $this->hasOne(Siswa::class, 'user_id', 'id');
    }
}
