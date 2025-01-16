<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | Kontroler ini bertanggung jawab untuk menangani permintaan reset password
    | dan menggunakan trait sederhana untuk menyertakan perilaku ini. Anda bebas
    | untuk menjelajahi trait ini dan menimpa metode apapun yang ingin Anda sesuaikan.
    |
    */

    /*Menggunakan trait ResetsPasswords untuk mengakses metode reset password*/
    use ResetsPasswords;

    /**
     * Dimana untuk mengalihkan pengguna setelah mereset password mereka.
     * @var string
     */

    /*Menentukan rute tujuan setelah pengguna berhasil reset ulang password */
    protected $redirectTo = RouteServiceProvider::HOME;
}
