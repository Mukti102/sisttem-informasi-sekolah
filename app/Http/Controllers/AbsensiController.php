<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class AbsensiController extends Controller
{
    /**
     * Menampilkan daftar absensi yang ada.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        /*Mengambil semua data guru dan kelas */
        $guru = Guru::all();
        $kelas = Kelas::all();

        /*Memeriksa peran pengguna yang sedang login */
        if (auth()->user()->roles == 'guru') {
            /*ambil data absensi berdasarkan ID guru*/
            $authGuru = Guru::where('user_id', auth()->user()->id)->first();
            $absensi = Absensi::with('kelas', 'guru', 'meetings')->where('guru_id', $authGuru->id)->get();
            /*Jika pengguna adalah siswa */
        } elseif (auth()->user()->roles == 'siswa') {
            /*ambil data absensi berdasarkan ID siswa*/
            $siswa = Siswa::where('user_id', auth()->user()->id)->first();
            $absensi = Absensi::with('kelas', 'guru', 'meetings')->where('kelas_id', $siswa->id)->get();
        } else {
            /*Jika pengguna bukan siswa atau guru, tampilkan semuanya (admin) */
            $absensi = Absensi::with('kelas', 'guru', 'meetings')->get();
        }

        /*Mengembalikan tampilan dengan data absensi, guru, dan kelas */
        return view('pages.admin.absensi.index', compact('absensi', 'guru', 'kelas'));
    } //pages.admin.absensi.index mengarahakan pengguna ke blade absensi yang ada pada pages/admin/absensi/index.blade.php//

    /**
     * Menampilkan form tambah absensi.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Fungsi ini belum diimplementasikan
    }

    /**
     * Menyimpan absensi baru ke dalam database.
     *
     * @param  \Illuminate\Http\Request  $request 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*Validasi data yang dikirim */
        $this->validate($request, [
            'guru_id' => 'required',
            'kelas_id' => 'required'
        ], [
            'guru_id.required' => 'Guru wajib diisi',
            'kelas_id.required' => 'Kelas wajib diisi'
        ]);

        /*Membuat  absensi baru */
        Absensi::create([
            'guru_id' => $request->guru_id,
            'kelas_id' => $request->kelas_id
        ]);

        /*Mengalihkan kembali ke halaman absensi */
        return redirect()->route('absensi.index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Menampilkan detail dari absensi yang dipilih.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /*Mendeskripsikan ID yang diterima */
        $id = Crypt::decrypt($id);

        /*Mencari data absensi berdasarkan ID */
        $absensi = Absensi::find($id);

        /*Mengambil data siswa yang terdaftar dikelas */
        $siswa = Siswa::with('presensi')->where('kelas_id', $absensi->kelas_id)->get();

        /*Mengambil data pertemuan terkait absensi */
        $meetings = $absensi->meetings;
        /*Mengembalikan tampilan detail absensi */
        return view('pages.admin.absensi.detail', compact('absensi', 'siswa', 'meetings'));
    }

    /**
     * Menampilkan form untuk mengedit absensi yang dipilih.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function edit(Absensi $absensi)
    {
        /*Mengambil semua data guru dan kelas untuk ditampilkan diform edit */
        $guru = Guru::all();
        $kelas = Kelas::all();

        /*Mengembalikan tampilan edit absensi dengan data yang diperlukan */
        return view('pages.admin.absensi.edit', compact('absensi', 'guru', 'kelas'));
    }

    /**
     * Memperbaharui data absensi yang dipilih
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Absensi $absensi)
    {
        /*Validasi input dari form edit */
        $this->validate($request, [
            'guru_id' => 'required',    //mewajibkan guru_id harus diisi//
            'kelas_id' => 'required'    //mewajibkan kelas_id harus diidi// 
        ], [
            /*Pesan kesalahan ketika salah satu tidak diisi */
            'guru_id.required' => 'Guru wajib diisi',
            'kelas_id.required' => 'Kelas wajib diisi'
        ]);

        /*Update data absensi yang dipilih */
        $absensi->update([
            'guru_id' => $request->guru_id,
            'kelas_id' => $request->kelas_id
        ]);

        /*Mengarahakn ke halaman index absensi */
        return redirect()->route('absensi.index')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Menghapus absensi yang dipilih dari penyimpanan
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*Mencari absensin berdasarkan ID dan menghapusnya dari database*/
        Absensi::find($id)->delete();

        /*Mengarahkan kembali ke halaman index absensi */
        return back()->with('success', 'Data Berhasil Di Hapus!');
    }
}
