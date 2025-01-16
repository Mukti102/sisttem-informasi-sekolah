<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ConfirmsPasswords;

class ConfirmPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Confirm Password Controller
    |--------------------------------------------------------------------------
    | 
    | Kontroler ini bertanggung jawab untuk menangani konfirmasi password
    | dan menggunakan trait sederhana untuk menyertakan perilaku tersebut.
    | Anda bebas untuk menjelajahi trait ini dan menimpa fungsi-fungsi
    | yang memerlukan kustomisasi.
    |
    */

    /*Menggunakan trait ConfirmsPasswords untuk mengaktifkan konfirmasi password*/
    use ConfirmsPasswords;

    /**
     * Di mana pengguna akan diarahkan ketika URL yang dimaksud gagal.
     *
     * @var string //tipe data yang digunakan//
     */

     /*Menentukan URL redirect setelah konfirmasi password*/
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Membuat instance baru dari kontroler.
     *
     * @return void
     */

     /*Menganisialisasi kontroler */
    public function __construct()
    {
        $this->middleware('auth'); //menggunakan auth untuk memastikan pengguna sudah login
    }
}
