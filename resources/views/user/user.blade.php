@extends('template.master')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data User</h1>
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    @if (Auth::user()->role_id == 3)
                    @else
                        <div class="card-header">
                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambah"><i
                                    class="fa fa-plus"></i> Tambah User</button>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="tableK" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="10">#</th>
                                        <th>NAMA</th>
                                        <th>USERNAME</th>
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
                                    @foreach ($user as $k)
                                        <tr>
                                            <td align="center">{{ $no++ }}</td>
                                            <td>{{ $k->name }}</td>
                                            <td>{{ $k->username }}</td>
                                            @if (Auth::user()->role_id == 3)
                                            @else
                                                <td width="50">
                                                    {{-- <a href="#" class="btn btn-sm btn-warning" data-target="#edit{{$k->id}}" data-toggle="modal"><i class="fa fa-edit"></i></a> --}}
                                                    <a onclick="return confirm('Apakah yakin dihapus ?')"
                                                        href="{{ route('hapusUser', ['id' => $k->id]) }}"
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
    <form action="{{ route('tambahUser') }}" method="post">
        @csrf
        <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6 form-group">
                                <label for="">NAMA</label>
                                <input required type="text" name="name" class="form-control">
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="Role">Role User</label>
                                <select required name="role_id" id="" class="form-control">
                                    <option value="">Role User</option>
                                    <option value="1">Super Admin</option>
                                    <option value="2">Boss / Manager</option>
                                    <option value="3">Karyawan</option>
                                </select>
                            </div>
                            <div class="col-lg-12 form-group">
                                <label for="">USERNAME</label>
                                <input required type="text" name="username" class="form-control">
                            </div>
                            <div class="col-lg-12 form-group">
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
    @foreach ($user as $k)
        <form action="{{ route('editUser') }}" method="post">
            @csrf
            <div class="modal fade" id="edit{{ $k->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" value="{{ $k->id }}">
                            <div class="form-group">
                                <label for="">NAMA</label>
                                <input type="text" name="name" value="{{ $k->name }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">USERNAME</label>
                                <input type="text" name="username" value="{{ $k->username }}" class="form-control">
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
