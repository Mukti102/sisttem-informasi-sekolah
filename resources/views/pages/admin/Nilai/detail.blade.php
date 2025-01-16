@extends('layouts.main')
@section('title', 'List Nilai Siswa ')

@section('content')
    <section class="section custom-section">
        {{-- card --}}
        <div class="section">
            <div class="section-body">
                <div class="row d-flex justify-content-start">
                    <div class="col-12 col-sm-12 col-lg-5">
                        <div class="card profile-widget">
                            <div class="card-header">
                                <h4>Informasi Kelas</h4>
                            </div>
                            <div class="profile-widget-description pb-0 p-0">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <strong>Kelas:</strong> &nbsp; {{ $kelas->nama_kelas }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Mata Pelajaran:</strong>&nbsp; {{ $guru->mapel->nama_mapel }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Guru:</strong> &nbsp; {{ $guru->nama }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>List Nilai Siswa</h4>
                        </div>
                        <div class="card-body">
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-dismissible show fade">
                                    <div class="alert-body">
                                        <button class="close" data-dismiss="alert">
                                            <span>&times;</span>
                                        </button>
                                        {{ $message }}
                                    </div>
                                </div>
                            @else
                            @endif
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-2">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nis</th>
                                            <th>Nama</th>
                                            <th>Harian</th>
                                            <th>UTS</th>
                                            <th>UAS</th>
                                            <th>Nilai Akhir</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($siswa as $data)
                                            @php
                                                // get nilai siswa
                                                $nilaiSiswa = DB::table('nilai_siswas')
                                                    ->where('siswa_id', $data->id)
                                                    ->where('nilai_id', $nilai->id)
                                                    ->first();
                                            @endphp
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $data->nis }}</td>
                                                <td>{{ $data->nama }}</td>
                                                <td>{{ $nilaiSiswa ? $nilaiSiswa->harian : '-' }}</td>
                                                <td>{{ $nilaiSiswa ? $nilaiSiswa->uts : '-' }}</td>
                                                <td>{{ $nilaiSiswa ? $nilaiSiswa->uas : '-' }}</td>
                                                <td>
                                                    @if ($nilaiSiswa)
                                                        {{ round(($nilaiSiswa->harian * 0.2) + ($nilaiSiswa->uts * 0.3) + ($nilaiSiswa->uas * 0.5), 2) }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (isset($nilaiSiswa) && (round(($nilaiSiswa->harian * 0.2) + ($nilaiSiswa->uts * 0.3) + ($nilaiSiswa->uas * 0.5), 2) < 70))
                                                        <span class="badge badge-danger">Tidak Tuntas</span>
                                                    @else
                                                        <span class="badge badge-success">Tuntas</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        @canany(['admin', 'guru'])
                                                            <button id="inputNilai"
                                                                data-data-harian="{{ $nilaiSiswa ? $nilaiSiswa->harian : '' }}"
                                                                data-data-uts="{{ $nilaiSiswa ? $nilaiSiswa->uts : '' }}"
                                                                data-data-uas="{{ $nilaiSiswa ? $nilaiSiswa->uas : '' }}"
                                                                data-id="{{ $data->id }}" data-toggle="modal"
                                                                data-target="#exampleModal"
                                                                class="inputNilai btn btn-success btn-sm"><i
                                                                    class="nav-icon fas fa-edit"></i> &nbsp; Input</button>
                                                        @endcan
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Input Nilai</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('nilaiSiswa.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
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
                                            <div class="form-group">
                                                <label for="harian">Nilai Harian</label>
                                                <input type="number" id="harian" name="harian"
                                                    class="form-control @error('harian') is-invalid @enderror"
                                                    placeholder="{{ __('Nilai') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="uts">Nilai UTS</label>
                                                <input type="number" id="uts" name="uts"
                                                    class="form-control @error('uts') is-invalid @enderror"
                                                    placeholder="{{ __('Nilai UTS') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="uas">Nilai UAS</label>
                                                <input type="number" id="uas" name="uas"
                                                    class="form-control @error('uas') is-invalid @enderror"
                                                    placeholder="{{ __('Nilai UAS') }}">
                                            </div>
                                            <div class="form-group" hidden>
                                                <input type="number" value="{{ $nilai->id }}" id="nilaiId"
                                                    name="nilai_id" class="form-control @error('uas') is-invalid @enderror">
                                            </div>
                                            <input type="number" hidden id="siswaId" name="siswaId"
                                                class="form-control @error('uas') is-invalid @enderror">
                                        </div>
                                    </div>
                                    <div class="modal-footer  br">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
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
@endsection

@push('script')
    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: `Yakin ingin menghapus data ini?`,
                    text: "Data akan terhapus secara permanen!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });

        // input nilain click
        $('.inputNilai').click(function(e) {
            var id = $(this).data('id'); // Ambil id siswa
            var harian = $(this).data('data-harian'); // Ambil nilai harian
            var uts = $(this).data('data-uts'); // Ambil nilai UTS
            var uas = $(this).data('data-uas'); // Ambil nilai UAS

            $('#harian').val(harian);
            $('#uts').val(uts);
            $('#uas').val(uas);
            $('#siswaId').val(id);
        })
    </script>
@endpush
