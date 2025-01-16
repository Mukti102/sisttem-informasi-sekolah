<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Jurusan;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class KelasController extends Controller
{
    /**
     * Menampilkan daftar kelas.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*Mengambil data kelas, guru, dan jurusan, diurutkan berdasarkan nama */
        $kelas = Kelas::orderBy('nama_kelas', 'asc')->get();
        $guru = Guru::orderBy('nama', 'asc')->get();
        $jurusan = Jurusan::orderBy('nama_jurusan', 'asc')->get();

        /*Mengarahkan kembali ke halaman sebelumnya */
        return view('pages.admin.kelas.index', compact('kelas', 'guru', 'jurusan'));
    }

    /**
     * Menampilkan form untuk membuat kelas baru
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*jika tidak diimplementasikan */
        abort(404);
    }

    /**
     * Menyimpan kelas yang baru dibuat ke dalam penyimpinan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*Validasi data yang diterima dari request */
        $this->validate($request, [
            'nama_kelas' => 'required|unique:kelas',
            'guru_id' => 'required|unique:kelas',
            'jurusan_id' => 'required'
        ], [
            'nama_kelas.unique' => 'Nama Kelas sudah ada',
            'guru_id.unique' => 'Guru sudah memiliki kelas',
            'jurusan_id.required' => 'Jurusan harus dipilih',
        ]);


        /*Membuat kelas baru dengan data yang telah divalidasi */
        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'guru_id' => $request->guru_id,
            'jurusan_id' => $request->jurusan_id
        ]);

        /*Mengarahkan kembali ke halaman sebelumnya*/
        return redirect()->route('kelas.index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Menampilkan kelas tertentu berdasarkan ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /*Jika tidak diimplementasikan */
        abort(404);
    }

    /**
     * Menampilkan form untuk mengedit kelas yang sudah ada
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $id = Crypt::decrypt($id);
        /*Mengambil data kelas berdasarkan ID, Jika tidak ditemukan akan muncul 404 */
        $kelas = Kelas::findOrFail($id);
        /*Mengambil data guru dan jurusan untuk dipilih */
        $guru = Guru::all();
        $jurusan = Jurusan::all();

        /*Mengarahkan kembali ke halaman sebelumnya*/
        return view('pages.admin.kelas.edit', compact('kelas', 'guru', 'jurusan'));
    }

    /**
     * Memperbarui data kelas yang sudah ada.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /*Validasi data yang diterima dari request */
        $this->validate($request, [
            'guru_id' => 'required|unique:kelas'
        ], [
            'guru_id.unique' => 'Guru sudah memiliki kelas'
        ]);

        /*Mengambik senua data dari request */
        $data = $request->all();

        /*Mencari kelas berdasarkan ID dan memperbarui data */
        $kelas = Kelas::findOrFail($id);
        $kelas->update($data);

        /*Mengarahkan kembali ke halaman sebelumnya*/
        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil diperbarui');
    }

    /**
     * Menghapus kelas berdasarkan ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*Mencari kelas berdasarkan ID dan menghapusnya */
        Kelas::find($id)->delete();

        /*Mengarahkan kembali ke halaman sebelumnya*/
        return back()->with('success', 'Data kelas berhasil dihapus!');
    }
}