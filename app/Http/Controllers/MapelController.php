<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MapelController extends Controller
{
    /**
     * Menampilkan daftar semua resource(mapel)
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guruId = auth()->user()->id;
        /*Mengambil data jurusan dan mapel dari database, diurutkan berdasarkan nama jurusan*/
        $jurusan = Jurusan::OrderBy('nama_jurusan', 'asc')->get();
        $mapel = Mapel::OrderBy('nama_mapel', 'asc')->get();

        /*Mengarahkan kembali ke halaman sebelumnya*/
        return view('pages.admin.mapel.index', compact('mapel', 'jurusan'));
    }

    /**
     *  Menampilkan form untuk membuat resource baru..
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*Jika tidak diimplementasikan */
        abort(404);
    }

    /**
     * Menyimpan resource baru ke dalam penyimpanan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        /*Validasi data yang diterima dari request */
        $this->validate($request, [
            'nama_mapel' => 'required|unique:mapels',
            'jurusan_id' => 'required'
        ], [
            'nama_mapel.unique' => 'Nama Mapel sudah ada',
        ]);

        // return $request;
        /*Memperbarui data mapel ke dalam database */
        Mapel::create([
            'nama_mapel' => $request->input('nama_mapel'),
            'jurusan_id' => $request->input('jurusan_id'),
        ]);

        /*Mengarahkan kembali ke halaman sebelumnya */
        return back()->with('success', 'Data mapel berhasil Tambahkan !');
    }

    /**
     * Menampilkan  mapel yang ditentukan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Menampilkan form untuk mengedit resource yang ditentukan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /*Mendeskripsikan ID dan mencari mapel berdasarkan ID */
        $id = Crypt::decrypt($id);
        $mapel = Mapel::findOrFail($id);

        /*Mengarahkan kembali ke halaman sebelumnya */
        return view('pages.admin.mapel.edit', compact('mapel'));
    }

    /**
     * Memperbarui mapel dalam penyimpanan
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /*Mengambil semua data dari request */
        $data = $request->all();

        /*Mencari mapel berdasarkan ID */
        $mapel = Mapel::findOrFail($id);

        /*Memperui data mapel dengan data baru */
        $mapel->update($data);

        /*Mengarahkan kembali ke halaman sebelumnya */
        return redirect()->route('mapel.index')->with('success', 'Data mapel berhasil diperbarui!');
    }

    /**
     * Menghapus mapel dari penyimpanan
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*Mencari dan menghapus mapel berdasarkan ID */
        Mapel::find($id)->delete();

        /*Mengarahkan kembali ke halaman sebelumnya */
        return back()->with('success', 'Data mapel berhasil dihapus!');
    }
}
