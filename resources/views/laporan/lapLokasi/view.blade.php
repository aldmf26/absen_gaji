@extends('template.master')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">{{ $title }}</h1>
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <a target="_blank" href="{{ route('exportLaporanLokasi') }}" class="btn btn-sm btn-success"><i
                                class="fa fa-file-pdf"></i> Export</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="10">#</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>No Hp</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no=1;
                                    @endphp
                                    @foreach ($lokasi as $k)                        
                                    <tr>
                                        <td align="center">{{ $no++ }}</td>
                                        <td>{{ $k->nm_gudang }}</td>
                                        <td >{{ $k->alamat }}</td>
                                        <td >{{ $k->no_hp }}</td>
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
