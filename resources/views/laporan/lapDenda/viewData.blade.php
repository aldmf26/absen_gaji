@extends('template.master')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">{{ $title }}</h1>
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <a target="_blank" href="{{ route('exportLapDataDenda') }}" class="btn btn-sm btn-success"><i
                                class="fa fa-file-pdf"></i> Export</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="10">#</th>
                                        <th>Tanggal</th>
                                        <th>Nama</th>
                                        <th>Nominal</th>
                                        <th>Keterangan</th>

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
