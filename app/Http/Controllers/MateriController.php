<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Materi;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class MateriController extends Controller
{
    /**
     * Menampilkan daftar materi 
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*Mengambil data guru berdasarkan user yang sedang login */
        $guru = Guru::where('user_id', Auth::user()->id)->first();

        /*Mengambil semua materi yang ada */
        $materi = Materi::where('guru_id', $guru->id)->get();

        /*Mengambil jadwal yang terkait dengan materi */
        $jadwal = Jadwal::where('mapel_id', $guru->mapel_id)->get();

        /*Mengembalikan tampilan dengan data materi, jadwal, dan guru */
        return view('pages.guru.materi.index', compact('materi', 'jadwal', 'guru'));
    }

    /**
     * Menampilkan form untuk membuat materi baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Menyimpan materi baru.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*Mengambil data guru berdasarkan nip */
        $guru = Guru::where('nip', Auth::user()->nip)->first();

        /*Validasi input, memastikan file upload dan  memiliki format yang diizinkan */
        $this->validate($request, [
            'file' => 'required|mimes:pdf,doc,docx,ppt,pptx,png,jpg,jpeg|max:2048',
        ]);

        /*Jika ada file yang diupload, simpan file tersebut */
        if (isset($request->file)) {
            $file = $request->file('file');
            $namaFile = time() . '.' . $file->getClientOriginalExtension();
            $file = $file->storeAs('file/materi', $namaFile, 'public');
        }

        /*Membuat objek materi baru */
        $materi = new Materi;
        $materi->guru_id = $guru->id;
        $materi->kelas_id = $request->kelas_id;
        $materi->judul = $request->judul;
        $materi->deskripsi = $request->deskripsi;
        $materi->file = $file;
        $materi->save();

         /*Mengarahkan kembali ke halaman sebelumnya */
        return redirect()->route('materi.index')->with('success', 'Materi berhasil ditambahkan');
    }

    /**
     * Menampilkan materi tertentu berdarkan ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Menampilkan form untuk mengedit materi.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /*Mendeskripsikan ID materi yang diterima */
        $id = Crypt::decrypt($id);

        /*Mengambil semua kelas */
        $kelas = Kelas::all();

        /*Mengambil materi berdasarkan ID */
        $materi = Materi::findOrFail($id);

         /*Mengarahkan kembali ke halaman sebelumnya */
        return view('pages.guru.materi.edit', compact('materi', 'kelas'));
    }

    /**
     * Memperbarui materi yang ada di dalam database
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Materi $materi)
    {
        /*Mengambil file yang diupload */
        $data = $request->all();

        /*Memperbarui data materi dengan data yang baru */
        $materi->update($data);

        /*Validasi input untuk file baru */
        $this->validate($request, [
            'file' => 'mimes:pdf,doc,docx,ppt,pptx,png,jpg,jpeg|max:2048',
        ]);

        /*Mengecek file yang diupload */
        if ($request->hasFile('file')) {

            /*Mengambil file dari request */
            $file = $request->file('file');

            /*Membuat nama file baru  */
            $namaFile = time() . '.' . $file->getClientOriginalExtension();

            /*Menyimpan file ke direktori */
            $file = $file->storeAs('file/materi', $namaFile, 'public');

            /*Menyimpan path file baru ke dalam objek materi */
            $materi->file = $file;
            $materi->save();

            /*Menghapus file lama */
            $oldFile = $materi->file;
            $path = storage_path('app/public/file/materi/' . $oldFile);

            /*Mengecek apakah file lama ada */
            if (File::exists($path)) {
                File::delete($path);
            } else {
                File::delete($path);
            }
        }

         /*Mengarahkan kembali ke halaman sebelumnya */
        return redirect()->route('materi.index')->with('success', 'Data materi berhasil diubah');
    }

    /**
     * Menghapus materi dari penyimpanan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*Mencari materi berdasarkan ID */
        $materi = Materi::find($id);

        /*Menyusun lokasi file yang akan dihapus */
        $lokasi = 'file/materi/' . $materi->file;

        /*Mengecek apakah file ada */
        if (File::exists($lokasi)) {
            File::delete($lokasi);
        }

        /*Menghapus materi dari database */
        $materi->delete();

         /*Mengarahkan kembali ke halaman sebelumnya */
        return redirect()->route('materi.index')->with('success', 'Data materi berhasil dihapus');
    }

    /*Mengambil data siswa, kelas, dan materi */
    public function siswa()
    {
        /*Mencari siswa berdasarkan NIS yang terautentikasi */
        $siswa = Siswa::where('nis', Auth::user()->nis)->first();

        /*Mencari kelas berdasarkan ID kelas yang dimiliki oleh siswa */
        $kelas = Kelas::findOrFail($siswa->kelas_id);

        /*Mengambil semua materi yang berkaitan dengan kelas tersebut */
        $materi = Materi::where('kelas_id', $kelas->id)->get();

        /*Mencari guru yang mengajar */
        $guru = Guru::findOrFail($kelas->guru_id);

         /*Mengarahkan kembali ke halaman sebelumnya */
        return view('pages.siswa.materi.index', compact('materi', 'guru', 'kelas'));
    }

    /*Mengunduh file materi berdasarkan ID */
    public function download($id)
    {
        /*Mencari materi berdasarkan ID */
        $file = Materi::findOrFail($id);

        /*Menyusun file yang diunduh */
        $path = storage_path('/app/public/' . $file->file);

         /*Mengarahkan kembali ke halaman sebelumnya */
        return Response::download($path);
    }
}
