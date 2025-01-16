<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Meeting;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MeetingController extends Controller
{
    /**
     * Menampilkan daftar pertemuan
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Fungsi ini untuk menampilkan daftar meeting, saat tidak diimplementasikan
    }

    /**
     * Menampilkan formulir untuk membuat meeting baru
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //saat tidak diimplementasikan
    }

    /**
     * Menyimpan data meeting baru
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*Validasi input dari pengguna */
        $this->validate($request, [
            'pertemuan_ke' => 'required',
            'absensi_id' => 'required'
        ], [
            'pertemuan_ke.required' => 'Pertemuan ke wajib diisi',
            'absensi_id.required' => 'Absensi wajib diisi'
        ]);

        /*Membuat meeting baru */
        Meeting::create([
            'pertemuan_ke' => $request->pertemuan_ke,
            'absensi_id' => $request->absensi_id
        ]);

         /*Mengarahkan kembali ke halaman sebelumnya */
        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    /**
     * Menampilkan sumber daya yang ditentukan.
     *
     * @param  \App\Models\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /*Mendeskripsi ID yang diterima */
        $id = Crypt::decrypt($id);

        /*Mencari meeting berdasarkan ID */
        $meeting = Meeting::find($id);

        /*Mengambil data absensi */
        $absensi = $meeting->absensi;

        /*Mengambil kelas dari absensi */
        $kelas = $absensi->kelas;

        /*Mengambil semua siswa yang terdaftar */
        $siswa = Siswa::where('kelas_id', $kelas->id)->get();

         /*Mengarahkan kembali ke halaman sebelumnya */
        return view('pages.admin.meeting.index', compact('meeting', 'siswa', 'absensi'));
    }

    /**
     * Menampilkan form untuk mengedit meeting
     *
     * @param  \App\Models\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function edit(Meeting $meeting)
    {
        //Fungsi untuk menampilkan form edit
    }

    /**
     * Memperbarui meeting yang ditentukan.
     *
     * @param  \Illuminate\Http\Request  $request //permintaan yang berisi data yang akan diupdate
     * @param  \App\Models\Meeting  $meeting        //instace dari model meeting yang akan diperbarui
     * @return \Illuminate\Http\Response            //mengembalikan respons HTTP setelah pembaruan
     */
    public function update(Request $request, Meeting $meeting)
    {
        //Fungsi untuk memperbarui data meeting yang telah ditambahkan
    }

    /**
     * Menghapus meeting yang ditentukan.
     *
     * @param  \App\Models\Meeting  $meeting    //ID dari meeting yang akan dihapus
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*Mendeskripsikan ID yang diterima */
        $id = Crypt::decrypt($id);

        /*Mencari dan menghapus meering berdasarkan ID  */
        Meeting::find($id)->delete();

        /*Mengembalikan ke halaman sebelumnya */
        return back()->with('success', 'Data Berhasil Di Hapus!');
    }
}
