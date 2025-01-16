<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | Controller ini menangani pendaftaran pengguna baru serta validasi dan
    | pembuatan mereka. Secara default, controller ini menggunakan trait 
    | untuk menyediakan fungsionalitas ini tanpa memerlukan kode tambahan.
    |
    */

    use RegistersUsers;

    /**
     * Tempat untuk mengarahkan pengguna setelah pendaftaran.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Membuat instance controller baru.
     *
     * @return void
     */
    public function __construct()
    {
        /*Menggunakan middleware untuk mengizinkan pengguna untuk mendaftar*/
        $this->middleware('guest');
    }

    /**
     * Mendapatkan validator untuk permintaan pendaftaran yang masuk.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    /*Memvalidasi data pendaftaraan*/
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Membuat instance pengguna baru setelah pendaftaran yang valid.
     *
     * @param  array  $data
     * @return \App\Models\User
     */

    /*Membuat pengguna baru */
    protected function create(array $data)
    {
        /*Mengambil model user untuk membuat entri baru di database */
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'roles' => 'siswa', // Tambahkan roles di sini
        ]);
    }
}
