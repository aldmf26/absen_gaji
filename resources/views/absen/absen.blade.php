@extends('template.master')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Absensi</h1>
        <div class="card shadow mb-4">

            <div class="card-header">
                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i>
                    Tambah Absen</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="tableK" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th>Jam Masuk</th>
                                <th>Jam Keluar</th>
                                <th>Keterangan</th>
                                <th>Lokasi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                                $no = 1;
                            @endphp
                            @foreach ($absen as $k)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $k->nm_karyawan }}</td>
                                    <td>{{ $k->tgl }}</td>
                                    <td>{{ $k->jam_masuk }}</td>
                                    <td>{{ $k->jam_keluar }}</td>
                                    <td>{{ $k->status }}</td>
                                    <td>{{ $k->nm_gudang }}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-warning"
                                            data-target="#edit{{ $k->id_absen }}" data-toggle="modal"><i
                                                class="fa fa-edit"></i></a>
                                        <a onclick="return confirm('Apakah yakin dihapus ?')"
                                            href="{{ route('hapusAbsen', ['id_absen' => $k->id_absen]) }}"
                                            class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>


    {{-- modal tambah karyawan --}}
    <!-- Modal -->
    <form action="{{ route('tambahAbsen') }}" method="post">
        @csrf
        <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Absen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <label for="">Tanggal</label>
                                @if (Auth::user()->role_id == 3)
                                    <input type="date" readonly value="{{ date('Y-m-d') }}" required name="tgl"
                                        class="form-control">
                                @else
                                    <input type="date" required name="tgl" class="form-control">
                                @endif
                            </div>
                            <div class="col-lg-4">
                                <label for="">Karyawan</label>
                                @if (Auth::user()->role_id == 3)
                                    @foreach ($karyawan as $w)
                                        <input type="hidden" name="id_karyawan" value="{{ $w->id }}">
                                        <input readonly type="text" class="form-control"
                                            value="{{ $w->nm_karyawan }}">
                                    @endforeach
                                @else
                                    <select name="id_karyawan" required id="" class="form-control">
                                        @foreach ($karyawan as $k)
                                            <option readonly selected value="{{ $k->id }}">{{ $k->nm_karyawan }}
                                            </option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                            <div class="col-lg-3">
                                <label for="">Lokasi</label>
                                <select name="id_lokasi" id="" class="form-control">
                                    <option value="">- Lokasi -</option>
                                    @foreach ($lokasi as $l)
                                        <option value="{{ $l->id_lokasi }}">{{ $l->nm_gudang }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <label for="">Status</label>
                                <select name="status" id="" class="form-control">
                                    <option value="">- Status -</option>
                                    @foreach ($status as $s)
                                        <option value="{{ $s->status }}">{{ $s->status }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-3 mt-2">
                                <div class="form-group">
                                    <label for="">Jam Masuk</label>
                                    <input type="time" class="form-control" name="jam_masuk">
                                </div>
                            </div>
                            <div class="col-lg-3 mt-2">
                                <div class="form-group">
                                    <label for="">Jam Keluar</label>
                                    <input type="time" class="form-control" name="jam_keluar">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @foreach ($absen as $a)
        <form action="{{ route('editAbsen') }}" method="post">
            @csrf
            <div class="modal fade" id="edit{{ $a->id_absen }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Absen</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <input type="hidden" name="id_absen" value="{{ $a->id_absen }}">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-8">
                                    <label for="">Lokasi</label>
                                    <select name="id_lokasi" id="" class="form-control">
                                        <option value="">- Lokasi -</option>
                                        @foreach ($lokasi as $l)
                                            <option value="{{ $l->id_lokasi }}"
                                                {{ $l->id_lokasi == $a->id_lokasi ? 'selected' : '' }}>
                                                {{ $l->nm_gudang }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <label for="">Status</label>
                                    <select name="status" id="" class="form-control">
                                        <option value="">- Status -</option>
                                        @foreach ($status as $s)
                                            <option {{ $s->status == $a->status ? 'selected' : '' }}
                                                value="{{ $s->status }}">{{ $s->status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endforeach
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#tableK').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
            });
        });
    </script>

    @if (Session::get('success'))
        <script>
            var pesan = "{{ Session::get('success') }}"
            Swal.fire({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1000,
                icon: 'success',
                title: pesan
            });
        </script>
    @elseif(Session::get('error'))
        <script>
            var pesan = "{{ Session::get('error') }}"
            Swal.fire({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1000,
                icon: 'error',
                title: pesan
            });
        </script>
    @endif


    <script>
        $(document).ready(function() {
            $('#select2').select2({

            });
        })
    </script>
@endsection
