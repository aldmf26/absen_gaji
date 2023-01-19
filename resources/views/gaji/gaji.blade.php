@extends('template.master')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Gaji Karyawan</h1>
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    @if (Auth::user()->role_id == 3)
                    @else
                        <div class="card-header">
                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambah"><i
                                    class="fa fa-plus"></i> Tambah gaji</button>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="tableK" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="10">#</th>
                                        <th>Nama</th>
                                        <th>Posisi</th>
                                        <th>Gaji</th>
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
                                    @foreach ($gaji as $k)
                                        <tr>
                                            <td align="center">{{ $no++ }}</td>
                                            <td>{{ $k->nm_karyawan }}</td>
                                            <td>{{ $k->posisi }}</td>
                                            <td>{{ number_format($k->rp_gaji, 0) }}</td>
                                            @if (Auth::user()->role_id == 3)
                                            @else
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-warning"
                                                        data-target="#edit{{ $k->id_gaji }}" data-toggle="modal"><i
                                                            class="fa fa-edit"></i></a>
                                                    <a onclick="return confirm('Apakah yakin dihapus ?')"
                                                        href="{{ route('hapusStatus', ['id_gaji' => $k->id_gaji]) }}"
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
    <form action="{{ route('tambahGaji') }}" method="post">
        @csrf
        <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-md">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Gaji Karyawan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="">Karyawan</label>
                                    <select name="id_karyawan" required id="" class="form-control">
                                        <option value="">Pilih Karyawan</option>
                                        @foreach ($karyawan as $k)
                                            <option value="{{ $k->id }}">{{ $k->nm_karyawan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Gaji</label>
                                    <input type="number" name="rp_gaji" class="form-control">
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

    {{-- modal edit --}}
    @foreach ($gaji as $k)
        <form action="{{ route('editGaji') }}" method="post">
            @csrf
            <div class="modal fade" id="edit{{ $k->id_gaji }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content modal-md">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Gaji</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id_gaji" value="{{ $k->id_gaji }}">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label for="">Nama</label>
                                        <select name="id_karyawan" required id="" class="form-control">
                                            <option value="">Pilih Karyawan</option>
                                            @foreach ($karyawan as $s)
                                                <option value="{{ $s->id }}"
                                                    {{ $s->id == $k->id_karyawan ? 'selected' : '' }}>
                                                    {{ $k->nm_karyawan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="">Gaji</label>
                                        <input type="number" name="rp_gaji" value="{{ $k->rp_gaji }}"
                                            class="form-control">
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
