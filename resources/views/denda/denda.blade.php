@extends('template.master')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">{{ $title }}</h1>
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    @if (Auth::user()->role_id == 3)
                    @else
                        <div class="card-header">
                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambah"><i
                                    class="fa fa-plus"></i> Tambah Denda</button>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="tableK" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="10">#</th>
                                        <th>Tanggal</th>
                                        <th>Nama</th>
                                        <th>Nominal</th>
                                        <th>Keterangan</th>
                                        @if (Auth::user()->role_id == 3)
                                        @else
                                            <th>AKSI</th>
                                        @endif

                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($denda as $k)
                                        <tr>
                                            <td align="center">{{ $no++ }}</td>
                                            <td>{{ $k->tgl }}</td>
                                            <td>{{ $k->nm_karyawan }}</td>
                                            <td>{{ number_format($k->jumlah, 0) }}</td>
                                            <td>{{ $k->ket }}</td>
                                            @if (Auth::user()->role_id == 3)
                                            @else
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-warning"
                                                        data-target="#edit{{ $k->id_denda }}" data-toggle="modal"><i
                                                            class="fa fa-edit"></i></a>
                                                    <a onclick="return confirm('Apakah yakin dihapus ?')"
                                                        href="{{ route('hapusDenda', ['id_denda' => $k->id_denda]) }}"
                                                        class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>


    {{-- modal tambah karyawan --}}
    <!-- Modal -->
    <form action="{{ route('tambahDenda') }}" method="post">
        @csrf
        <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-md">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Denda</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-4 form-group">
                                <label for="">Tanggal</label>
                                <input required type="date" class="form-control" name="tgl">
                            </div>
                            <div class="col-lg-8 form-group">
                                <label for="">Nama</label>
                                <select name="id_karyawan" id="" class="form-control">
                                    <option value="">- Pilih Karyawan -</option>
                                    @foreach ($karyawan as $k)
                                        <option value="{{ $k->id }}">{{ $k->nm_karyawan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4 form-group">
                                <label for="">Nominal</label>
                                <input required type="number" min="0" class="form-control" name="jumlah">
                            </div>
                            <div class="col-lg-8 form-group">
                                <label for="">Keterangan</label>
                                <input type="text" name="ket" class="form-control">
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
    @foreach ($denda as $k)
        <form action="{{ route('editDenda') }}" method="post">
            @csrf
            <div class="modal fade" id="edit{{ $k->id_denda }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content modal-md">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Denda</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <input type="hidden" name="id_denda" value="{{ $k->id_denda }}">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-4 form-group">
                                    <label for="">Tanggal</label>
                                    <input value="{{ $k->tgl }}" required type="date" class="form-control"
                                        name="tgl">
                                </div>
                                <div class="col-lg-8 form-group">
                                    <label for="">Nama</label>
                                    <select name="id_karyawan" id="" class="form-control">
                                        <option value="">- Pilih Karyawan -</option>
                                        @foreach ($karyawan as $s)
                                            <option {{ $k->id == $s->id ? 'selected' : '' }}
                                                value="{{ $s->id }}">{{ $s->nm_karyawan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label for="">Nominal</label>
                                    <input value="{{ $k->jumlah }}" required type="number" min="0"
                                        class="form-control" name="jumlah">
                                </div>
                                <div class="col-lg-8 form-group">
                                    <label for="">Keterangan</label>
                                    <input value="{{ $k->ket }}" type="text" name="ket"
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
