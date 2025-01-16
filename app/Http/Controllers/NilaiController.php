<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class NilaiController extends Controller
{
    /**
     * Menampilkan daftar nilai
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*Mengambil data guru yang sedang login */
        $authGuru = Guru::where('user_id', auth()->user()->id)->first();
        $authSiswa = Siswa::where('user_id', auth()->user()->id)->first();

        /*Mengambil semua data guru dan kelas */
        $guru = Guru::with('mapel')->get();
        $nilai = Nilai::with('guru')->get();
        $kelas = Kelas::with('guru')->get();

        /*Jika pengguna adalah guru, ambil nilai berdasarkan guru yang sedang login */
        if ($authGuru) {
            $nilai = Nilai::where('guru_id', $authGuru->id)->get();
            
        /*jika pengguna adalah guru,, ambil nilai sesuai dengan kelas siswa */
        } else if ($authSiswa) {
            $nilai = Nilai::where('kelas_id', $authSiswa->kelas_id)->get();
        
        /*Jika bukan guru dan bukan siswa, maka tampilkan semua nilai (admin)*/
        } else {
            $nilai = Nilai::with('guru')->get();
        }

        /*Mengembalikan tampilan dengan data guru, nilai dan  kelas */
        return view('pages.admin.Nilai.index', compact('guru', 'nilai', 'kelas'));
    }

    /**
     * Menampilkan form untuk membuat nilai baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       /* $siswa = Siswa::all();
        $tugas = Tugas::all();
        return view('nilai.create', compact('siswa', 'tugas')); */
    }

    /**
     * Menyimpan nilai yang baru dibuat ke dalam database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'guru_id' => 'required',
            'kelas_id' => 'required',
        ], [
            'guru_id.required' => 'Guru harus dipilih',
            'kelas_id.required' => 'Kelas harus dipilih',
        ]);

        Nilai::create([
            'guru_id' => $request->guru_id,
            'kelas_id' => $request->kelas_id
        ]);

        return redirect()->route('nilai.index')->with('success', 'Data berhasil disimpan');
    }


    /**
     * Menampilkan detail dari nilai yang ditentukan.
     *
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /*Mendeskripsi ID nilai yang diterima */
        $id = Crypt::decrypt($id);

        /*Mencari nilai berdasarkan ID */
        $nilai = Nilai::find($id);

        /*Mengambil data guru dan kelas dari nilai */
        $guru = $nilai->guru;
        $kelas = $nilai->kelas;

        /*Mengambil semua siswa yang berada dikelas yang sama */
        $siswa = Siswa::where('kelas_id', $kelas->id)->get();
        return view('pages.admin.Nilai.detail', compact('guru', 'nilai', 'kelas', 'siswa'));
    }

    /**
     * Menampilkan form untuk mengedit nilai yang ditentukan
     *
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function edit(Nilai $nilai)
    {
        //Fungsi menampilkan form edit nilai
    }

    /**
     * Memperbarui nilai yang ditentukan di dalam penyimpanan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nilai $nilai)
{
    //
}
    /**
     * Menghapus nilai dari database
     *
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*Mencari dan menghapus nilai berdasarkan ID */
        Nilai::find($id)->delete();
        return redirect()->route('nilai.index')->with('success', 'Data berhasil dihapus');
    }

 

}
