<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Mapel;
use Illuminate\Http\Request;

class JadwalGuruController extends Controller
{
    /**
     * Menampilkan resource
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*Mengambil semua jadwal dan mengurutkannya berdasarkan hari secara menurun */
        $jadwal = Jadwal::orderBy('hari', 'desc')->get();

        /*Mengambil semua mata pelajaran dan mengurutkannya berdasarkan nama secara menurun */
        $mapel = Mapel::orderBy('nama_mapel', 'desc')->get();

        /*Mengambil semua kelas dan mengurutkannya berdasarkan nama secara menurun */
        $kelas = Kelas::orderBy('nama_kelas', 'desc')->get();

        /*Mengembalikan view dengan data jadwal, mata pelajaran, dan kelas */
        return view('pages.siswa.jadwal.index', compact('jadwal', 'mapel', 'kelas'));
    }

    /**
     * Menampilkan formulir untuk membuat resource
     *
     * @return \Illuminate\Http\Response
     */

     /*Menampilkan formulir untuk membuat jadwal */
    public function create()
    {
        //
    }

    /**
     * Menyimpan sumber daya yang baru dibuat ke dalam penyimpanan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     /*Menyimpan jadwal baru */
    public function store(Request $request)
    {
        /*Mengambil semua data dari request */
        $data = $request->all();

        /*Validasi data yang diterima */
        $this->validate($request, [
            'kelas_id' => 'required',
            'mapel_id' => 'required|unique:jadwals,dari_jam',
            'hari' => 'required',
            'dari_jam' => 'required',
            'sampai_jam' => 'required',
        ], [
            /*Pesan error jika tidak diisi */
            'kelas_id.required' => 'Kelas wajib diisi',
            'mapel_id.required' => 'Mata Pelajaran wajib diisi',
            'mapel_id.unique' => 'Mata Pelajaran sudah ada di jam tersebut',
            'hari.required' => 'Hari wajib diisi',
            'dari_jam.required' => 'Jam mulai wajib diisi',
            'sampai_jam.required' => 'Jam selesai wajib diisi',
        ]);

        /*Membuat jadwal baru */
        Jadwal::create([
            'kelas_id' => $data['kelas_id'],
            'mapel_id' => $data['mapel_id'],
            'hari' => $data['hari'],
            'dari_jam' => $data['dari_jam'],
            'sampai_jam' => $data['sampai_jam'],
        ]);

        /*Mengalihkan kembali dengan pesan sukses */
        return redirect()->back()->with('success', 'Jadwal berhasil dibuat');
    }

    /**
     * Menampilkan jadwal
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     /*Menampilkan detail jadwal jika tidak diidentifikasi */
    public function show($id)
    {
        abort(404); //menghasilkan error
    }

    /**
     * Menampilkan formulis untuk mengedit jadwal yang ditentukan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     /*Menampilkan formulis edit jadwal */
    public function edit($id)
    {
        /*Mencari jadwal berdasarkan ID */
        $jadwal = Jadwal::find($id);
        /*Mengambil semua mata pelajaran */
        $mapel = Mapel::orderBy('nama_mapel', 'desc')->get();

        /*Mengambil semua data kelas dari database dan mengurutkan berdasarkan kelas secara menurun */
        $kelas = Kelas::orderBy('nama_kelas', 'desc')->get();

        /*Mendefenisikan array yang berisi nama-nama hari dalam seminggu */
        $hari = ['senin', 'selasa', 'rabu', 'kamis', 'jumat'];

        /*Mengembalikan tampilanjadwal */
        return view('pages.admin.jadwal.edit', compact('jadwal', 'mapel', 'kelas', 'hari'));
    }

    /**
     * Memperbaharui jadwal yang ditentukan dalam penyimpanan.
     *
     * @param  \Illuminate\Http\Request  $request   //permintaan yang berisi data untuk diperbarui
     * @param  int  $id                             //ID dari jadwal yang akan diperbarui
     * @return \Illuminate\Http\Response            //Mengarahkan kembali dengan pesan sukses
     */
    public function update(Request $request, $id)
    {
        /*Mengambil semua data dari permintaan */
        $data = $request->all();

        /*Mencari jadwal berdasarkan ID */
        $jadwal = Jadwal::findOrFail($id);

        /*Memperbarui data jadwal  */
        $jadwal->update($data);

        /*Mengembalikan pesan sukses */
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbaharui');
    }

    /**
     * Menghapus jadwal yang ditentukan dari penyimpanan
     *
     * @param  int  $id                     //id dari jadwal yang akan dihapus
     * @return \Illuminate\Http\Response    //Mengarahkan kembali dengan pesan sukses
     */
    public function destroy($id)
    {
        /*Mencari jadwal berdasarkan ID */
        $jadwal = Jadwal::find($id);

        /*Menghapus jadwal dari database */
        $jadwal->delete();

        /*Mengarahkan kembali ke halaman jadwal dengan pesan sukses */
        return redirect()->back()->with('success', 'Jadwal berhasil dihapus');
    }
}
