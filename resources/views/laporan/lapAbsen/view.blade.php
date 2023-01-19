@extends('template.master')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">{{ $title }}</h1>
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <a target="_blank" href="{{ route('exportLapAbsen') }}" class="btn btn-sm btn-success"><i
                                class="fa fa-file-pdf"></i> Export</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="10">#</th>
                                        <th>Nama</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Lokasi</th>
     
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
                                        <td>{{ $k->status }}</td>
                                        <td>{{ $k->nm_gudang }}</td>
       
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
@endsection
