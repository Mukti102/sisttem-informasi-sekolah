<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | Controller ini menangani otentikasi pengguna untuk aplikasi dan
    | mengarahkan mereka ke layar beranda setelah login. Kontroler ini
    | menggunakan trait untuk menyediakan fungsionalitas ini dengan mudah.
    |
    */

    /*Menggunakan trait */
    use AuthenticatesUsers;

    /**
     * Tempat untuk mengarahkan pengguna setelah login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Membuat isntance kontroler baru.
     *
     * @return void
     */
    public function __construct()
    {
        /*Mengatur untuk mengizinkan akseh ke kontroler ini hanya untuk pengguna yang sudah login*/
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        /*Memeriksa peran pengguna dan mengarahkan sesuai dengan perannya*/
        if($user->roles == 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif($user->roles == 'guru') {
            return redirect()->route('guru.dashboard');
        } else return redirect()->route('siswa.dashboard');
    }
}
