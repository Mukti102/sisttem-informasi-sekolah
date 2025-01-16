@php
    use App\Models\Siswa;
@endphp
@extends('layouts.main')

@section('title', 'Absensi')

@section('content')
    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <div class="alert-body">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span>&times;</span>
                </button>
                {{ Session::get('error') }}
            </div>
        </div>
    @endif

    <div class="section custom-section">
        <section class="section custom-section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>List Absensi</h4>
                            </div>
                            <div class="card-body">
                                @if (Session::has('success'))
                                    <div class="alert alert-success alert-dismissible fade show">
                                        <div class="alert-body">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span>&times;</span>
                                            </button>
                                            {{ Session::get('success') }}
                                        </div>
                                    </div>
                                @endif

                                <div class="table-responsive">
                                    <form action="{{ route('presensi.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="meeting_id" value="{{ $meeting->id }}">
                                        <input type="hidden" name="absensi_id" value="{{ Crypt::encrypt($absensi->id) }}">

                                        <table class="table table-bordered text-center align-middle">
                                            <thead class="table-primary">
                                                <tr>
                                                    <th>No</th>
                                                    <th>NIS</th>
                                                    <th>Nama Siswa</th>
                                                    <th>Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($siswa as $data)
                                                    @php
                                                        $presensi = optional(
                                                            $absensi->meetings
                                                                ->where('id', $meeting->id)
                                                                ->first()
                                                                ->presensi->where('siswa_id', $data->id)
                                                                ->first(),
                                                        );
                                                        $status = $presensi ? $presensi->status : null;
                                                    @endphp

                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $data->nis }}</td>
                                                        <td>{{ $data->nama }}</td>
                                                        <td>
                                                            <select name="keterangan[{{ $data->id }}]"
                                                                class="form-select w-100 h-100 border-0 outline-0 form-select-sm">
                                                                <option value=""
                                                                    {{ is_null($status) ? 'selected' : '' }}>Tanpa
                                                                    Keterangan</option>
                                                                <option value="hadir"
                                                                    {{ $status == 'hadir' ? 'selected' : '' }}>Hadir
                                                                </option>
                                                                <option value="izin"
                                                                    {{ $status == 'izin' ? 'selected' : '' }}>Izin</option>
                                                                <option value="sakit"
                                                                    {{ $status == 'sakit' ? 'selected' : '' }}>Sakit
                                                                </option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-end mt-3 space-x-3">
                                            <a href="{{ route('absensi.show', Crypt::encrypt($absensi->id)) }}"
                                                class="btn mx-2 btn-danger">Kembali</a>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
