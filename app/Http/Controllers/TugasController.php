<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Jawaban;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class TugasController extends Controller
{
    /**
     * Menampilkan daftar tugas.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        /*Mengambil data guru */
        $guru = Guru::where('user_id', Auth::user()->id)->first();
        /*Mengambil data kelas */
        $tugas = Tugas::where('guru_id', $guru->id)->get();
        /*Mengambil jadwal sesuai dengan mapel guru */
        $jadwal = Jadwal::where('mapel_id', $guru->mapel_id)->get();

        return view('pages.guru.tugas.index', compact('tugas', 'jadwal'));
    }

    /**
     * Menampilkan form untuk membuat tugas baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*Mengambil smeua kelas yang ada untuk ditampilkan */
        $kelas = Kelas::all();
        return view('pages.guru.tugas.create', compact('kelas'));
    }

    /**
     * Menyimpan tugas baru ke dalam database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*Mengambil data guru */
        $guru = Guru::where('nip', Auth::user()->nip)->first();

        /*Melakukan validasi untuk memastikan file yang diupload sesuai format */
        $this->validate($request, [
            'file' => 'required|mimes:pdf,doc,docx,ppt,pptx,png,jpg,jpeg|max:2048',
        ]);

        /*Jika ada file yang diupload, simpan file tersebut */
        if (isset($request->file)) {
            $file = $request->file('file');
            $namaFile = time() . '.' . $file->getClientOriginalExtension();
            $file = $file->storeAs('file/tugas', $namaFile, 'public');
        }

        /*Membuat objek tugas baru dan mengisi atributnya */
        $tugas = new Tugas;
        $tugas->guru_id = $guru->id;
        $tugas->kelas_id = $request->kelas_id;
        $tugas->judul = $request->judul;
        $tugas->deskripsi = $request->deskripsi;
        $tugas->file = $file;
        $tugas->save();

        return redirect()->route('tugas.index')->with('success', 'Tugas berhasil ditambahkan');
    }

    /**
     * Menampilkan detail dari tugas yang dipilih.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /*Mencari tugas berdasarkan id */
        $tugas = Tugas::find($id);
        /*Mencari kelas yang terkait dengan tugas */
        $kelas = Kelas::find($tugas->kelas_id);
        /*Mengambil semua jawaban yang terkait */
        $jawaban = Jawaban::where('tugas_id', $id)->get();
        return view('pages.guru.tugas.show', compact('tugas', 'kelas', 'jawaban'));
    }


    /**
     * Menampilkan form untuk mengedit tugas.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /*Mendeskripsi ID yang diterima */
        $id = Crypt::decrypt($id);
        /*Mencari tugas berdasarkan id */
        $tugas = Tugas::find($id);
        /*Mencari kelas yang terkait dengan tugas */
        $kelas = Kelas::all();
        return view('pages.guru.tugas.edit', compact('tugas', 'kelas'));
    }

    /**
     * Mengupdate tugas pada database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        /*Mengambil demua data dari request */
        $data = $request->all();

        /*Mencari tugas berdasarkan ID */
        $tugas = Tugas::find($id);
        $tugas->update($data);

        /*Validasi file yang diupload */
        $this->validate($request, [
            'file' => 'mimes:pdf,doc,docx,ppt,pptx,png,jpg,jpeg|max:2048',
        ]);

        /*Jika ada file yang diupload */
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $namaFile = time() . '.' . $file->getClientOriginalExtension();
            $file = $file->storeAs('file/tugas', $namaFile, 'public');
            $tugas->file = $file;
            $tugas->save();

            /*Menghapus file */
            $oldFile = $tugas->file;
            $path = storage_path('app/public/file/tugas/' . $oldFile);
            if (File::exists($path)) {
                File::delete($path);
            } else {
                File::delete($path);
            }
        }

        return redirect()->route('tugas.index')->with('success', 'Tugas berhasil diubah');
    }

    /**
     * Menghapus file yang ada di penyimpanan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*Mencari tugas berdasarkan ID */
        $tugas = Tugas::find($id);
        /*Menentukan lokasi file tugas yang akan dihapus */
        $lokasi = 'file/tugas/' . $tugas->file;
        /*Mengecek apakah file ada di penyimpanan */
        if (File::exists($lokasi)) {
            File::delete($lokasi);
        }
        /*Menghapus tugas dari database */
        $tugas->delete();

        return redirect()->route('tugas.index')->with('success', 'Tugas berhasil dihapus');
    }

    public function siswa()
    {
        /*Mencari siswa berdasarkan NIS yang terautentikasi */
        $siswa = Siswa::where('nis', Auth::user()->nis)->first();
        /*Mencari kelas berdasarkan ID kelas siswa */
        $kelas = Kelas::findOrFail($siswa->kelas_id);
        /*Mengambil semua tugas yang terkait dengan kelas */
        $tugas = Tugas::where('kelas_id', $kelas->id)->get();
        /*Mencari guru berdasarkan ID guru kelas */
        $guru = Guru::findOrFail($kelas->guru_id);

        /*Mengambil jawaban dari tugas yang telah dikirim ole siswa */
        $jawaban = Jawaban::where('siswa_id', $siswa->id)->get();

        return view('pages.siswa.tugas.index', compact('tugas', 'guru', 'kelas', 'jawaban'));
    }

    public function download($id)
    {
        /*Mencari tugas berdasaarkan ID */
        $file = Tugas::findOrFail($id);
        /*Menentukan lokasi file tugas */
        $path = storage_path('/app/public/' . $file->file);
        /*Mengunduh file tugas */
        return Response::download($path);
    }

    public function kirimJawaban(Request $request)
    {
        /*Mencari siswa berdasarkan NIS yang terautentikasi */
        $siswa = Siswa::where('nis', Auth::user()->nis)->first();

        /*Memeriksa apakah ada file yang diunggah dalam permintaan */
        if (isset($request->file)) {
            /*Mengambil file yang diunggah */
            $file = $request->file('file');
            /*Membuat nama file baru dengan menambahkan timestamp */
            $namaFile = time() . '.' . $file->getClientOriginalExtension();
            /*Menyimpan file */
            $file = $file->storeAs('file/jawaban', $namaFile, 'public');
        }

        /*Mebuat instance baru dari model jawaban */
        $jawaban = new Jawaban;
        /*Mengisi data jawaban */
        $jawaban->tugas_id = $request->tugas_id;
        $jawaban->siswa_id = $siswa->id;
        $jawaban->jawaban = $request->jawaban;
        $jawaban->file = $file;
        $jawaban->save();

        return redirect()->back()->with('success', 'Jawaban berhasil dikirim');
    }

    /*Fungsi untuk mengunduh berdasarkan ID yang diberikan */
    public function downloadJawaban($id)
    {
        /*Mencari jawaban berdasarkan ID */
        $file = Jawaban::findOrFail($id);
        /*Menentukan lokasi file jawaban */
        $path = storage_path('/app/public/' . $file->file);
        /*Mengunduh file jawaban */
        return Response::download($path);
    }

    public function nilais()
{
    return $this->hasMany(Nilai::class);
}

}
