<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Menampilkan detail pengguna yang terdaftar
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        /*Mengambil semua pengguna dan mengurutkan berdasarkan peran  */
        $user = User::OrderBy('roles', 'asc')->get();
        return view('pages.admin.user.index', compact('user'));
    }

    /**
     * Menampilkan form untuk membuat user baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Menyimpan user baru ke dalam database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*validasi input dari pengguna */
        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'roles' => 'required'
        ], [
            'email.unique' => 'Email sudah terdaftar',
        ]);

        /*Jika peran adalah guru */
        if ($request->roles == 'guru') {
            /*Menghitung jumlah guru dengan NIP  yang diberikan  */
            $countGuru = Guru::where('nip', $request->nip)->count();
            /*Mengambil data guru berdasarkan NIP */
            $guruId = Guru::where('nip', $request->nip)->get();
            foreach ($guruId as $val) {
                $guru = Guru::findOrFail($val->id);
            }

            /*Jika NIP terdaftar sebagai guru */
            if ($countGuru >= 1) {
                /*Membuat pengguna baru dengan data yang diberikan  */
                User::create([
                    'name' => $guru->nama,
                    'email' => $request->email,
                    'password' => Hash::make($request->password), //memberikan password sebelum disimpan
                    'roles' => $request->roles,
                    'nip' => $request->nip
                ]);

                // Menambahkan user id ke tabel guru
                $guru->user_id = User::where('email', $request->email)->first()->id;
                $guru->save();


                return redirect()->route('user.index')->with('success', 'Data user berhasil ditambahkan');
            } else {
                return redirect()->route('user.index')->with('error', 'NIP tidak terdaftar sebagai guru');
            }
        } elseif ($request->roles == "siswa") {
            /*Menghitung jumlah siswa dengan NIS yang diberikan */
            $countSiswa = Siswa::where('nis', $request->nis)->count();
            /*Mengambil data siswa berdasarkan NIS */
            $siswaId = Siswa::where('nis', $request->nis)->get();
            foreach ($siswaId as $val) {
                $siswa = Siswa::findOrFail($val->id);
            }

            /*Jika NIS terdaftar sebagai siswa */
            if ($countSiswa >= 1) {
                /*Membuat pengguna baru dengan data yang diberikan  */
                User::create([
                    'name' => $siswa->nama,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'roles' => $request->roles,
                    'nis' => $request->nis
                ]);

                /*Menambahka user_id ke tabel siswa untuk mengaitkan pengguna dengan siswa */
                $siswa->user_id = User::where('email', $request->email)->first()->id;
                $siswa->save();
                return redirect()->route('user.index')->with('success', 'Data user berhasil ditambahkan');
                /*Jika NIS tidak terdaftar sebagai siswa, maka akan menampilkan pesan error */
            } else {
                return redirect()->route('user.index')->with('error', 'NIS tidak terdaftar sebagai siswa');
            }
        /*Membuat user baru dengan data yang diberikan */
        } else {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'roles' => $request->roles
            ]);
            return redirect()->route('user.index')->with('success', 'Data user berhasil ditambahkan');
        }
    }

    /**
     * Menampilkan form yang ditentukan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        abort(404);
    }

    /**
     * Menampilkan form untuk mengedit user yang ditentukan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        /*Mengambil data guru, siswa, dan admin berdasarkan user yang sedang logi  */
        $guru = Guru::where('user_id', Auth::user()->id)->first();
        $siswa = Siswa::where('user_id', Auth::user()->id)->first();
        $admin = User::findOrFail(Auth::user()->id);

        return view('pages.profile', compact('guru', 'siswa', 'admin'));
    }

    /**
     * Memperbarui form user yang ditentukan dalam penyimpanan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        /*Memeriksa peran pengguna yang sedang login */
        if (Auth::user()->roles == 'guru') {
            $data = $request->all();

            /*Menyimpan data ke tabel guru */
            $guru = Guru::where('user_id', Auth::user()->id)->first();
            $guru->nama = $data['nama'];
            $guru->nip = $data['nip'];
            $guru->alamat = $data['alamat'];
            $guru->no_telp = $data['no_telp'];
            $guru->update($data);

            // Menyimpan data ke tabel user
            $user = Auth::user();
            $user->name = $data['nama'];
            $user->email = $data['email'];
            $user->update($data);
        } else if (Auth::user()->roles == 'siswa') {

            $data = $request->all();

            // Menyimpan data ke tabel siswa
            $siswa = Siswa::where('user_id', Auth::user()->id)->first();
            $siswa->nama = $data['nama'];
            $siswa->nis = $data['nis'];
            $siswa->alamat = $data['alamat'];
            $siswa->telp = $data['telp'];
            $siswa->update($data);

            // Menyimpan data ke tabel user
            $user = Auth::user();
            $user->name = $data['nama'];
            $user->email = $data['email'];
            $user->update($data);
        } else {
            $data = $request->all();

            // Menyimpan data ke tabel user
            $user = Auth::user();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->update($data);
        }

        return redirect()->route('profile')->with('success', 'Data berhasil diubah');
    }

    /**
     * Menghapus user yang ditentukan dari database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*Menghapus user berdasarkan ID yang diberikan */
        User::destroy($id);
        return redirect()->route('user.index')->with('success', 'Data user berhasil dihapus');
    }

    /*Menampilkan form untuk mengedit password */
    public function editPassword()
    {
        /*Mengambil data guru, siswa, dan admin berdasarkan user yang sedang login */
        $guru = Guru::where('user_id', Auth::user()->id)->first();
        $siswa = Siswa::where('user_id', Auth::user()->id)->first();
        $admin = User::findOrFail(Auth::user()->id);

        return view('pages.ubah-password', compact('guru', 'siswa', 'admin'));
    }

    public function updatePassword(Request $request)
    {

        /*Mengambil semua data dari request untuk diubah */
        // dd($request->all());

        /*Memeriksa apakah password saat ini yang dimasukkan pengguna cocok dengan password yang tersimpan di database */
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            return redirect()->back()->with("error", "Password lama tidak sesuai");
        }

        /*Memeriksa apakah password baru yang dimasukkan pengguna cocok dengan konfirmasi password */
        if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
            return redirect()->back()->with("error", "Password baru tidak boleh sama dengan password lama");
        }

        /*Melakukan validasi pada input dari request */
        $this->validate($request, [
            'current-password' => 'required',
            'new-password' => 'required|string|min:6',
        ], [
            'new-password.min' => 'Password baru minimal 6 karakter',
        ]);

        /*Mengubah Password */
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();


        return redirect()->route('profile')->with('success', 'Password berhasil diubah');
    }
}
