<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | Controller ini bertanggung jawab untuk menangani pengiriman email reset password
    | dan menyertakan trait yang membantu dalam mengirimkan notifikasi ini dari
    | aplikasi Anda kepada pengguna. Silakan eksplorasi trait ini.
    |
    */

    /*Menggunakan trait SendsPasswordResetEmails untuk mengelola pengiriman email reset password*/
    use SendsPasswordResetEmails;
}
