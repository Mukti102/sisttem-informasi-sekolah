<?php

namespace App\Http\Controllers;

use App\Models\NilaiSiswa;
use Illuminate\Http\Request;

class NilaiSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'siswaId' => 'required',
            'harian' => 'required',
            'uts' => 'required',
            'uas' => 'required'
        ]);

        $nilaiId = $request->nilai_id;

        // cek apakaha siswa sudah ada nilai
        $cek = NilaiSiswa::where('siswa_id', $request->siswaId)->where('nilai_id', $nilaiId)->first();
        if ($cek) {
            $cek->update([
                'harian' => $request->harian,
                'uts' => $request->uts,
                'uas' => $request->uas
            ]);
            return redirect()->route('nilai.show', encrypt($nilaiId))->with('success', 'Data berhasil disimpan');
        } else {
            NilaiSiswa::create([
                'nilai_id' => $nilaiId,
                'siswa_id' => $request->siswaId,
                'harian' => $request->harian,
                'uts' => $request->uts,
                'uas' => $request->uas
            ]);
            return redirect()->route('nilai.show', encrypt($nilaiId))->with('success', 'Data berhasil disimpan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NilaiSiswa  $nilaiSiswa
     * @return \Illuminate\Http\Response
     */
    public function show(NilaiSiswa $nilaiSiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NilaiSiswa  $nilaiSiswa
     * @return \Illuminate\Http\Response
     */
    public function edit(NilaiSiswa $nilaiSiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NilaiSiswa  $nilaiSiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NilaiSiswa $nilaiSiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NilaiSiswa  $nilaiSiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(NilaiSiswa $nilaiSiswa)
    {
        //
    }
}
