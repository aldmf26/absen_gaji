@extends('template.master')
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Status Absen</h1>
    <div class="row">
        <div class="col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah Status</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tableK" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no=1;
                                @endphp
                                @foreach ($status as $k)                        
                                <tr>
                                    <td align="center">{{ $no++ }}</td>
                                    <td>{{ $k->status }}</td>
                                    <td >{{ $k->ket }}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-warning" data-target="#edit{{$k->id_status}}" data-toggle="modal"><i class="fa fa-edit"></i></a>
                                        <a onclick="return confirm('Apakah yakin dihapus ?')" href="{{ route('hapusStatus',['id_status' => $k->id_status]) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                    </td>
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
{{-- <form action="{{ route('tambahStatus') }}" method="post">
      @csrf
    <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content modal-md">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Status</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">Status</label>
                            <input type="text" required name="status" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="form-group">
                            <label for="">Keterangan</label>
                            <input type="text" name="ket" class="form-control">
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
</form> --}}

{{-- modal edit --}}
{{-- @foreach ($status as $k)
<form action="{{ route('editStatus') }}" method="post">
    @csrf
  <div class="modal fade" id="edit{{$k->id_status}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
      <div class="modal-content modal-md">
          <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Status</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          </div>
          <div class="modal-body">
              <input type="hidden" name="id_status" value="{{ $k->id_status }}">
              <div class="row">
                  <div class="col-lg-4">
                    <div class="form-group">
                        <label for="">Status</label>
                        <input type="text" required name="status" value="{{ $k->status }}" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-8">
                    <div class="form-group">
                        <label for="">Keterangan</label>
                        <input type="text" name="ket" value="{{ $k->ket }}" class="form-control">
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
@endforeach   --}}


@endsection
@section('script')
    <script>
        $(document).ready( function () {
            $('#tableK').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
            });
        } );
    </script>

    @if (Session::get('success'))
    <script>    
    var pesan = "{{Session::get('success')}}"
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
    var pesan = "{{Session::get('error')}}"
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