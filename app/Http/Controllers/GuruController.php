<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Mapel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;

class GuruController extends Controller
{
    /**
     * Menampilkan data guru.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*Mengambil data mapel yang diurutkan berdasarkan nama mapel*/
        $mapel = Mapel::orderBy('nama_mapel', 'asc')->get();

        /*Mengambil data guru yang diurutkan berdasarkan nama guru*/
        $guru = Guru::orderBy('nama', 'asc')->get();

        /*Mengembalikan view dengan data mapel dan guru*/
        return view('pages.admin.guru.index', compact('guru', 'mapel'));
    }

    /**
     * Menampilkan form untuk membuat guru baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*Mengembalikan 404 Not Found karena tidak ada form untuk membuat guru baru*/
        abort(404);
    }

    /**
     * Menyimpan data guru baru.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        /*Validasi data yang dikirim */
        $this->validate($request, [
            'nama' => 'required',
            'nip' => 'required|unique:gurus',
            'no_telp' => 'required',
            'alamat' => 'required',
            'mapel_id' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ], [
            'nip.unique' => 'NIP sudah terdaftar',
        ]);

        /*Menyimpan foto jika ada*/
        if(isset($request->foto)){
            $file = $request->file('foto');
            $namaFoto = time() . '.' . $file->getClientOriginalExtension();
            $foto = $file->storeAs('images/guru', $namaFoto, 'public');
        }

        /*Membuat instance baru dari model Guru */
        $guru = new Guru;
        $guru->nama = $request->nama;
        $guru->nip = $request->nip;
        $guru->no_telp = $request->no_telp;
        $guru->alamat = $request->alamat;
        $guru->mapel_id = $request->mapel_id;
        $guru->foto = $foto;
        $guru->save();

        /*Mengalihkan ke halaman index */
        return redirect()->route('guru.index')->with('success', 'Data guru berhasil ditambahkan');
    }

    /**
     * Menampilkan detail guru berdasarkan ID
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /*Mendeskripsi data guru berdasarkan ID */
        $id = Crypt::decrypt($id);

        /*Mencari data guru berdasarkan ID */
        $guru = Guru::findOrFail($id);

        /*Mengambalikan biew dengan data guru */
        return view('pages.admin.guru.profile', compact('guru'));
    }

    /**
     * Menampilkan form edit guru
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /*Mendeskripsi data guru berdasarkan ID */
        $id = Crypt::decrypt($id);

        /*Mengambil semua mapel */
        $mapel = Mapel::all();

        /*Mencari data guru berdasarkan ID */
        $guru = Guru::findOrFail($id);

        /*Mengembalikan view untuk edit */
        return view('pages.admin.guru.edit', compact('guru', 'mapel'));
    }

    /**
     * Memperbaharui data guru
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /*Validasi data yang diterima dari request */
        $this->validate($request, [
            'nip' => 'required|unique:gurus' //menandalan nip wajib diisi
        ], [
            'nip.unique' => 'NIP sudah terdaftar', //menandakan tidak boleh ada nip sama
        ]);

        /*Mencari data guru berdasarkan ID yang diberikan*/
        $guru = Guru::find($id);

        /*Mengupdate atribut guru dengan data yang diinputkan dari data yang dikirim */
        $guru->nama = $request->input('nama');
        $guru->nip = $request->input('nip');
        $guru->no_telp = $request->input('no_telp');
        $guru->alamat = $request->input('alamat');
        $guru->mapel_id = $request->input('mapel_id');

        /*Memeriksa apakah ada file foto yang diupload */
        if($request->hasFile('foto'))
        {
            /*Menentukan lokasi file foto */
            $lokasi = 'images/guru/'.$guru->foto;

            /*Jika file foto ada, maka menghapus file foto lama */
            if(File::exists($lokasi)) {
                File::delete($lokasi);
            }

            /*Mengambil file foto yang diupload */
            $foto = $request->file('foto');

            /*Membuat nama file foto baru dengan timestamp */
            $namaFoto = time() . '.' . $foto->getClientOriginalExtension();

            /*Menentukan tujuan penyimpanan foto baru */
            $tujuanFoto = public_path('/images/guru');

            /*Memindahkan file foto ke lokasi penyimpanan */
            $foto->move($tujuanFoto, $namaFoto);

            /*Mengupadate atribut foto guru */
            $guru->foto = $namaFoto;
        }

        /*Menyimpan perubahan yang telah dilakukan */
        $guru->update();

        /*Mengarahkan kembali ke halaman indeks guru */
        return redirect()->route('guru.index')->with('success', 'Data guru berhasil diperbarui');
    }

    /**
     * Menghapus data guru yang ditentukan dari penyimpanan
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*Mencari data guru berdasarkan ID yang diberikan */
        $guru = Guru::find($id);

        /*Menghapus data guru */
        $guru->delete();

        /*Hapus data guru dari database*/
        if($user = User::where('id', $guru->user_id)->first()){
            $user->delete();
        }

        /*Mengarahkan kembali setelah penghapusan */
        return back()->with('success', 'Data mapel berhasil dihapus!');
    }
}
