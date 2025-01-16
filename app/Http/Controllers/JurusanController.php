<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    /**
     * Menampilkan daftar jurusan
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*Mengambil semua jurusan dari database */
        $jurusan = Jurusan::OrderBy('nama_jurusan', 'asc')->get();

        /*Mengarahkan kembali ke halaman index dengan data jurusan */
        return view('pages.admin.jurusan.index', compact('jurusan'));
    }

    /**
     * Menampilkan form untuk membuat jurusan baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*tidak ada form yang disediakan */
        abort(404);
    }

    /**
     * Menyimpan jurusan baru ke dalam database
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*Memvalidasi inputan dari form  tidak kosong dan menggunakan kode unik*/
        $this->validate($request, [
            'nama_jurusan' => 'required|unique:jurusans',
        ], [
            'nama_jurusan.unique' => 'Nama Jurusan sudah ada',
        ]);

        /*Membuat jurusan baru dengan data dari request */
        Jurusan::create([
            'id' => $request->jurusan_id,
            'nama_jurusan' => $request->nama_jurusan,
        ]);

        /*Mengarahkan kembali ke halaman sebelumnya*/
        return back()->with('success', 'Data jurusan berhasil dibuat!');
    }

    /**
     * Menampilkan jurusan yang ditentukan
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     /*Jika id tidak ditemukan, maka akan mengarahkan ke halaman 404 */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Menampilkan form untuk mengedit jurusan yang ditentukan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /*Mencari jurusan berdasarkan ID  */
        $jurusan = Jurusan::findOrFail($id);

        /*Mengarahkan kembali ke halaman sebelumnya */
        return view('pages.admin.jurusan.edit', compact('jurusan'));
    }

    /**
     * Memperbarui jurusan yang ditentukan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /*Memvalidasi data yang dikirim */
        $this->validate($request, [
            'nama_jurusan' => 'unique:jurusans',
        ], [
            'nama_jurusan.unique' => 'Nama Jurusan sudah ada',
        ]);

        /*Mengambil semua data dari request */
        $data = $request->all();

        /*Mencari jurusan berdasarkan ID */
        $jurusan = Jurusan::findOrFail($id);

        /*Memperbarui data jurusan */
        $jurusan->update($data);

        /*Mengarahkan kembali ke halaman sebelumnya */
        return redirect()->route('jurusan.index')->with('success', 'Data jurusan berhasil diperbaharui!');
    }

    /**
     * Menghapus jurusan yang ditentukan dari database
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*Mencari jurusan berdasarkan ID */
        $jurusan = Jurusan::findOrFail($id);

        /*Menghapus jadwal */
        $jurusan->delete();

        /*Mengarahkan kembali ke halaman sebelumnya */
        return back()->with('success', 'Data jurusan berhasil dihapus!');
    }
}
