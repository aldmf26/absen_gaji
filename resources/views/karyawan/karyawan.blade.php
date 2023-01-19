@extends('template.master')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data Karyawan</h1>
        <div class="card shadow mb-4">
            <div class="card-header">
                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i>
                    Tambah Karyawan</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="tableK" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Tanggal Masuk</th>
                                <th>Alamat</th>
                                <th>No Hp</th>
                                <th>Posisi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($karyawan as $k)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $k->nm_karyawan }}</td>
                                    <td>{{ $k->tgl_masuk }}</td>
                                    <td>{{ $k->alamat }}</td>
                                    <td>{{ $k->no_hp }}</td>
                                    <td>{{ $k->posisi }}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-warning"
                                            data-target="#edit{{ $k->id }}" data-toggle="modal"><i
                                                class="fa fa-edit"></i></a>
                                        <a onclick="return confirm('Apakah yakin dihapus ?')"
                                            href="{{ route('hapusKaryawan', ['id' => $k->id]) }}"
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
    <form action="{{ route('tambahKaryawan') }}" method="post">
        @csrf
        <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Karyawan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6  form-group">
                                <label for="">NAMA</label>
                                <input required type="text" name="nm_karyawan" class="form-control">
                            </div>
                            <div class="col-lg-6  form-group">
                                <label for="">TANGGAL MASUK</label>
                                <input required type="date" name="tgl_masuk" class="form-control">
                            </div>
                            <div class="col-lg-7 form-group">
                                <label for="">Alamat</label>
                                <input required type="text" name="alamat" class="form-control">
                            </div>
                            <div class="col-lg-5 form-group">
                                <label for="">No Hp</label>
                                <input required type="number" class="form-control" name="no_hp">
                            </div>
                            <div class="col-lg-12  form-group">
                                <label for="">POSISI</label>
                                <input required type="text" name="posisi" class="form-control">
                            </div>
                            <div class="col-lg-6  form-group">
                                <label for="">USERNAME</label>
                                <input required type="text" name="username" class="form-control">
                            </div>
                            <div class="col-lg-6  form-group">
                                <label for="">PASSWORD</label>
                                <input required type="password" name="password" class="form-control">
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

    {{-- modal edit --}}
    @foreach ($karyawan as $k)
        <form action="{{ route('editKaryawan') }}" method="post">
            @csrf
            <div class="modal fade" id="edit{{ $k->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Karyawan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" value="{{ $k->id }}">
                            <div class="row">
                                <div class="col-lg-6  form-group">
                                    <label for="">NAMA</label>
                                    <input value="{{ $k->nm_karyawan }}" required type="text" name="nm_karyawan"
                                        class="form-control">
                                </div>
                                <div class="col-lg-6  form-group">
                                    <label for="">TANGGAL MASUK</label>
                                    <input value="{{ $k->tgl_masuk }}" required type="date" name="tgl_masuk"
                                        class="form-control">
                                </div>
                                <div class="col-lg-7 form-group">
                                    <label for="">Alamat</label>
                                    <input value="{{ $k->alamat }}" required type="text" name="alamat"
                                        class="form-control">
                                </div>
                                <div class="col-lg-5 form-group">
                                    <label for="">No Hp</label>
                                    <input value="{{ $k->no_hp }}" required type="number" class="form-control"
                                        name="no_hp">
                                </div>
                                <div class="col-lg-12  form-group">
                                    <label for="">POSISI</label>
                                    <input value="{{ $k->posisi }}" required type="text" name="posisi"
                                        class="form-control">
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
@endsection
