<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Materi;
use App\Models\Siswa;
use App\Models\Tugas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Membuat instance controller baru dan menerapkan middleware auth.
     *
     * @return void
     */
    public function __construct()
    {
        /*Memastikan pengguna sudah terautentikasi */
        $this->middleware('auth');
    }

    /**
     * Menampilkan dashboard
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /*Menampilkan tampilan home */
        return view('home');
    }

    /**
     * Menampilkan dashboard untuk admin.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function admin()
    {
        /*Menghitung total guru, siswa, dan kelas */
        $siswa = Siswa::count();
        $guru = Guru::count();
        $kelas = Kelas::count();
        $mapel = Mapel::count();

        /*Mengambil siswa baru yang terakhir didaftarkan */
        $siswaBaru = Siswa::orderByDesc('id')->take(5)->orderBy('id')->first();

        /*Mengembalikan tampilan dashboard admin */
        return view('pages.admin.dashboard', compact('siswa', 'guru', 'kelas', 'mapel', 'siswaBaru'));
    }

    /**
     * Menampilkan dashboard untuk guru.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function guru()
    {
        /*Mengambil data guru berdasarkan user yang sedang login */
        $guru = Guru::where('user_id', Auth::user()->id)->first();

        /*Menghitung jumlah materi yang telah dibuat oleh guru */
        $materi = Materi::where('guru_id', $guru->id)->count();

        /*Mengambil jadwal berdasarkan mapel yang diajarkan oleh guru */
        $jadwal = Jadwal::where('mapel_id', $guru->mapel_id)->get();

        /*Menghitung jumlah tugas yang telah dibuat oleh guru */
        $tugas = Tugas::where('guru_id', $guru->id)->count();

        /*Mendapatkan hari saat ini dalam format tanggal */
        $hari = Carbon::now()->locale('id')->isoFormat('dddd');

        /*Mengembalikan tampilan dashboard guru */
        return view('pages.guru.dashboard', compact('guru', 'materi', 'jadwal', 'hari', 'tugas'));
    }

    /**
     * Menampilkan dashboard untuk siswa.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function siswa()
    {
        /*Mengambil data siswa berdasarkan NIS yang sedang login */
        $siswa = Siswa::where('nis', Auth::user()->nis)->first();

        /*Mengambil kelas siswa berdasarkan ID Kelas */
        $kelas = Kelas::findOrFail($siswa->kelas_id);

        /*Mengambil 3 materi terakhir yang tersedia di kelas siswa */
        $materi = Materi::where('kelas_id', $kelas->id)->limit(3)->get();

        /*Mengambil 3 tugas terakhir yang tersedia di kelas siswa */
        $tugas = Tugas::where('kelas_id', $kelas->id)->limit(3)->get();

        /*Mengambil jadwal kelas siswa */
        $jadwal = Jadwal::where('kelas_id', $kelas->id)->get();

        /*Mendapatkan hari saat ini dalam format lokal */
        $hari = Carbon::now()->locale('id')->isoFormat('dddd');

        /*Mengembalikan tampilan dashboard siswa */
        return view('pages.siswa.dashboard', compact('materi', 'siswa', 'kelas', 'tugas', 'jadwal', 'hari'));
    }
}
