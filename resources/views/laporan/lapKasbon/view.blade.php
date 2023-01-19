@extends('template.master')
@section('content')
    @php
    function tgl_indo($tanggal)
    {
        $bulan = [
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        ];
        $pecahkan = explode('-', $tanggal);

        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun

        return $pecahkan[2] . ' ' . $bulan[(int) $pecahkan[1]] . ' ' . $pecahkan[0];
    }
    @endphp
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">{{ $title }} {{ tgl_indo(date($tgl1)) }} ~ {{ tgl_indo(date($tgl2)) }}
        </h1>
        <div class="row">
            <div class="col-lg-12">
                <form method="get" action="">

                    <div class="row form-group mt-4">
                        <div class="col-lg-2">
                            <label for="">Dari</label>
                            <input required type="date" class="form-control" name="tgl1">
                        </div>
                        <div class="col-lg-2">
                            <label for="">Sampai</label>
                            <input type="date" class="form-control" name="tgl2">
                        </div>
                        <div class="col-lg-1">
                            <label for=""> </label>
                            <button type="submit" class="btn btn-md btn-primary" style="margin-top: 33px">View</button>
                        </div>
                        <div class="col-lg-2">
                            <label for=""> </label>
                            <a href="{{ route('exportLapKasbon', ['tgl1' => $tgl1, 'tgl2' => $tgl2]) }}" target="_blank"
                                style="margin-top: 33px" class="btn btn-md btn-success"><i class="fa fa-file-pdf"></i>
                                Export</a>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                @php
                    $no = 1;
                    // dd($hasil);
                @endphp
                <table class="table mb-5">
                    <thead class="thead-light">
                        <tr>
                            <th width="10">#</th>
                            <th width="30%">Nama</th>
                            <th width="30%">Total</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($kasbon as $k)
                            <tr>
                                <td align="center" width="10">{{ $no++ }}</td>
                                <td width="40%">{{ $k->nm_karyawan }}</td>
                                <td width="10%">{{ $k->ttl }}</td>
                                <td>{{ number_format($k->jumlah, 0) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>

    </div>
@endsection
