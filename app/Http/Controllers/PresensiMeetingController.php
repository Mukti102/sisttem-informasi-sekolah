<?php

namespace App\Http\Controllers;

use App\Models\PresensiMeeting;
use App\Models\Siswa;
use Illuminate\Http\Request;

class PresensiMeetingController extends Controller
{
    /**
     * Menampilkan daftar semua presensi
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Fungsi untuk menampilkan daftar presensi
    }

    /**
     * Menampilkan form untuk membuat presensi meeting baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Fungsi untuk menampilkan form membuat presensi meeting baru
    }

    /**
     * Menyimpan presensi yang baru dibuat ke dalam database
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            /*Mengambil ID absensi dan keterangan dari request */
            $absensiId = $request->input('absensi_id');
            $keterangan = $request->input('keterangan');

            /*Melakukan validasi data */
            foreach ($keterangan as $id => $value) {
                $siswa = Siswa::find($id);
                // cek apakah siswa sudah absen 
                $presensi = PresensiMeeting::where('siswa_id', $id)->where('meeting_id', $request->input('meeting_id'))->first();

                /*Jika sudah ada, maka update keterangan */
                if ($presensi) {
                    $presensi->update([
                        'status' => $value
                    ]);
                    continue;
                } else {
                    /*Jika belum, buat entri baru untuk presensi */
                    PresensiMeeting::create([
                        'siswa_id' => $siswa->id,
                        'status' => $value,
                        'meeting_id' => $request->input('meeting_id')
                    ]);
                }
            }

            return redirect()->route('absensi.show', $absensiId)->with('success', 'Data berhasil disimpan');
            /*Menangani kesalahan dan mengalihkan ke pesan error */
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan presensi meeting yang ditentukan.
     *
     * @param  \App\Models\PresensiMeeting  $presensiMeeting
     * @return \Illuminate\Http\Response
     */
    public function show(PresensiMeeting $presensiMeeting)
    {
        //Fungsi untuk menampilkan detaul presensi
    }

    /**
     * Menampilkan form untuk mengupdate presensi meeting.
     *
     * @param  \App\Models\PresensiMeeting  $presensiMeeting
     * @return \Illuminate\Http\Response
     */
    public function edit(PresensiMeeting $presensiMeeting)
    {
        //Fungsi untuk menampilkan form edit presensi
    }

    /**
     * Memperbarui presensi meeting.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PresensiMeeting  $presensiMeeting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PresensiMeeting $presensiMeeting)
    {
        //Fungsi untuk memperbarui presensi
    }

    /**
     * Menghapus presensi meeting dari database.
     *
     * @param  \App\Models\PresensiMeeting  $presensiMeeting
     * @return \Illuminate\Http\Response
     */
    public function destroy(PresensiMeeting $presensiMeeting)
    {
        //Fungsi untuk menghapus presensi meeting
    }
}
