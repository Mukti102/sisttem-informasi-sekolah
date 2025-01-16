@extends('layouts.main')
@section('title', 'List Absensi')

@section('content')
    <section class="section custom-section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>List Absensi</h4>
                            @can('admin')
                                <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i
                                        class="nav-icon fas fa-folder-plus"></i>&nbsp; Tambah Data Absensi</button>
                            @endcan
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
                                            <th>Kelas</th>
                                            <th>Guru Pengampu</th>
                                            <th>Mata Pelajaran</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($absensi as $data)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $data->kelas->nama_kelas }}</td>
                                                <td>{{ $data->guru->nama }}</td>
                                                <td>{{ $data->guru->mapel->nama_mapel }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('absensi.show', Crypt::encrypt($data->id)) }}"
                                                            class="btn btn-primary btn-sm" style="margin-right: 8px"><i
                                                                class="nav-icon fas fa-eye"></i> &nbsp; Lihat</a>
                                                        @can('admin')
                                                            <a href="{{ route('absensi.edit', $data->id) }}"
                                                                class="btn btn-success btn-sm"><i
                                                                    class="nav-icon fas fa-edit"></i> &nbsp; Edit</a>
                                                            <form method="POST"
                                                                action="{{ route('absensi.destroy', $data->id) }}">
                                                                @csrf
                                                                @method('delete')
                                                                <button class="btn btn-danger btn-sm show_confirm"
                                                                    data-toggle="tooltip" title='Delete'
                                                                    style="margin-left: 8px"><i
                                                                        class="nav-icon fas fa-trash-alt"></i> &nbsp;
                                                                    Hapus</button>
                                                            </form>
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
                                <h5 class="modal-title">Tambah Absensi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('absensi.store') }}" method="POST">
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
                                                <label for="kelas_id">Kelas</label>
                                                <select id="kelas_id" name="kelas_id" class="select2 form-control ">
                                                    <option value="">-- Pilih Kelas --</option>
                                                    @foreach ($kelas as $data)
                                                        <option value="{{ $data->id }}">{{ $data->nama_kelas }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="guru_id">Guru Pengampu</label>
                                                <select id="guru_id" name="guru_id" class="select2 form-control ">
                                                    <option value="">-- Pilih Guru Pengampu --</option>
                                                    @foreach ($guru as $data)
                                                        <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="mapel">Mata Pelajaran</label>
                                                <input class="form-control" readonly type="text" id="mapel" />
                                            </div>
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
    </script>
@endpush
