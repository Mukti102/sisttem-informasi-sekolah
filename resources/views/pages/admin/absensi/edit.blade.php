@extends('layouts.main')
@section('title', 'Edit Absensi')

@section('content')
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible show fade">
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                    <span>&times;</span>
                                </button>
                                @foreach ($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>Edit absensi {{ $absensi->kelas->nama_kelas }}</h4>
                            <a href="{{ route('absensi.index') }}" class="btn btn-primary">Kembali</a>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('absensi.update', $absensi->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="guru_id">Guru Pengampu</label>
                                    <select id="guru_id" name="guru_id"
                                        class="select2bs4 form-control @error('guru_id') is-invalid @enderror">
                                        <option value="">-- Pilih Guru Pengampu --</option>
                                        @foreach ($guru as $data)
                                            <option value="{{ $data->id }}"
                                                @if ($absensi->guru_id == $data->id) selected @endif>{{ $data->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="kelas_id">Kelas</label>
                                    <select id="kelas_id" name="kelas_id"
                                        class="select2bs4 form-control @error('kelas_id') is-invalid @enderror">
                                        <option value="">-- Pilih Kelas --</option>
                                        @foreach ($kelas as $data)
                                            <option value="{{ $data->id }}"
                                                @if ($absensi->kelas_id == $data->id) selected @endif>{{ $data->nama_kelas }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i>
                                        &nbsp; Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
