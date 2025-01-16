@php
    use App\Models\Siswa;
@endphp
@extends('layouts.main')

@section('title', 'Absensi')

@section('content')
    <div class="section custom-section">
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
                                        <strong>Kelas:</strong> &nbsp; {{ $absensi->kelas->nama_kelas }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Mata Pelajaran:</strong>&nbsp; {{ $absensi->guru->mapel->nama_mapel }}
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Guru:</strong> &nbsp; {{ $absensi->guru->nama }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="section custom-section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>List Absensi</h4>
                                @canany(['admin', 'guru'])
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i
                                            class="nav-icon fas fa-folder-plus"></i>&nbsp; Tambah Pertemuan</button>
                                @endcanany
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
                                    <table class="table table-bordered" id="table-2">
                                        <thead>
                                            <tr class="bg-primary">
                                                <th class="p-2 text-center text-white" rowspan="2">No</th>
                                                <th class="p-2 text-center text-white" rowspan="2">NIS</th>
                                                <th class="p-2 text-center text-white" rowspan="2">Nama Siswa</th>
                                                <th class="p-2 text-center text-white"
                                                    colspan="{{ $meetings ? $meetings->count() : 0 }}">
                                                    Pertemuan Ke</th>
                                                <th class="p-2 text-center text-white" colspan="5">Jumlah</th>
                                            </tr>
                                            <tr class="bg-primary">
                                                @if ($meetings->count() > 0)
                                                    @foreach ($meetings as $data)
                                                        <th @if (auth()->user()->roles !== 'siswa') data-meeting-id="{{ Crypt::encrypt($data->id) }}"
                                                            data-toggle="modal" data-target="#exampleModal1" @endif
                                                            style="cursor: pointer" data-toggle="tooltip"
                                                            title='{{ 'Pertemuan ke ' . $data->pertemuan_ke }}'
                                                            class="p-2  bg-dark  text-center text-white">
                                                            {{ $data->pertemuan_ke }}</th>
                                                    @endforeach
                                                @else
                                                    <th class="p-2 bg-dark text-center text-white">
                                                        0</th>
                                                @endif
                                                <th class="p-2 text-center bg-success text-white">H</th>
                                                <th class="p-2 text-center bg-info text-white">S</th>
                                                <th class="p-2 text-center bg-primary text-white">I</th>
                                                <th class="p-2 text-center bg-danger text-white">A</th>
                                                <th class="p-2 text-center bg-warning text-white">T</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($siswa as $data)
                                                <tr>
                                                    <td class="bg-light p-2 text-center">{{ $loop->iteration }}</td>
                                                    <td class="bg-light p-2 text-center">{{ $data->nis }}</td>
                                                    <td class="bg-light p-2 text-center">{{ $data->nama }}</td>
                                                    @if ($meetings->count() > 0)
                                                        @foreach ($meetings as $meeting)
                                                            @php
                                                                $presensi = $data
                                                                    ->presensi()
                                                                    ->where('meeting_id', $meeting->id)
                                                                    ->first();
                                                            @endphp
                                                            <td class="bg-light p-2 text-center">
                                                                @if ($presensi)
                                                                    <span style="text-transform: uppercase;"
                                                                        class="px-1 rounded text-white
                                                                    @if ($presensi->status === 'hadir') bg-success 
                                                                    @elseif($presensi->status == 'sakit') bg-info 
                                                                    @elseif($presensi->status == 'izin') bg-primary 
                                                                    @elseif($presensi->status == 'alpha') bg-danger 
                                                                    @elseif($presensi->status == 'telat') bg-warning @endif
                                                                ">
                                                                        {{-- Menampilkan status --}}
                                                                        {{ substr($presensi->status, 0, 1) }}
                                                                    </span>
                                                                @else
                                                                    <span class="">-</span>
                                                                @endif
                                                            </td>
                                                        @endforeach
                                                    @else
                                                        <td class="bg-light p-2 text-center">
                                                            <span class="badge bg-secondary">-</span>
                                                        </td>
                                                    @endif
                                                    <td class="bg-light p-2 text-center">
                                                        {{ $data->presensi()->whereIn('status', ['hadir'])->count() }}
                                                    </td>
                                                    <td class="bg-light p-2 text-center">
                                                        {{ $data->presensi()->whereIn('status', ['sakit'])->count() }}
                                                    </td>
                                                    <td class="bg-light p-2 text-center">
                                                        {{ $data->presensi()->whereIn('status', ['izin'])->count() }}
                                                    </td>
                                                    <td class="bg-light p-2 text-center">
                                                        {{ $data->presensi()->whereIn('status', ['alpha'])->count() }}
                                                    </td>
                                                    <td class="bg-light p-2 text-center">
                                                        {{ $data->presensi()->whereIn('status', ['T'])->count() }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- tambah pertemuan --}}
                    <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Pertemuan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('meeting.store') }}" method="POST">
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
                                                    <label for="pertemuan_ke">Pertemuan Ke</label>
                                                    <input class="form-control"
                                                        value="{{ $meetings->count() > 0 ? $meetings->last()->pertemuan_ke + 1 : 1 }}"
                                                        readonly type="text" id="pertemuan_ke" name="pertemuan_ke" />
                                                </div>
                                                <div class="form-group" hidden>
                                                    <label for="absensi_id">Absensi</label>
                                                    <input class="form-control" value="{{ $absensi->id }}" readonly
                                                        type="text" id="absensi_id" name="absensi_id" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-whitesmoke br">
                                            <button type="button" class="btn btn-danger"
                                                data-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- view --}}
                    <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal1">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Kelola Pertemuan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="view">Pertemuan Ke</label>
                                            <input class="form-control" readonly type="text" id="view"
                                                name="view" />
                                        </div>
                                        <input type="hidden" id="meeting_id" name="meeting_id" />
                                    </form>
                                </div>
                                <div class="modal-footer flex justify-content-between bg-whitesmoke br">
                                    <form method="POST" id="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" id="delete-meeting-id" name="meeting_id" />
                                        <button type="submit" class="btn btn-danger">Hapus Pertemuan</button>
                                    </form>
                                    <a class="btn btn-primary" id="manage-meeting-btn">Kelola
                                        Absensi</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#exampleModal1').on('show.bs.modal', function(e) {
                var button = $(e.relatedTarget);
                var meetingId = button.data('meeting-id');
                var pertemuanKe = button.text().trim();

                var modal = $(this);
                modal.find('.modal-body #view').val(pertemuanKe);
                modal.find('.modal-body #meeting_id').val(meetingId);

                // Update form untuk hapus
                modal.find('#delete-meeting-id').val(meetingId);

                // delete action
                $('#delete-form').attr('action', '/meeting/' + meetingId);

                // kelola absensi
                $('#manage-meeting-btn').attr('href', '/meeting/' + meetingId);

            });

        });
    </script>
@endpush
