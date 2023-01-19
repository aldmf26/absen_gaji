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

                    <input type="hidden" name="jenis" value="{{ $jenis }}">
                    <input type="hidden" name="menu" value="{{ $menu }}">
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
                            <label for="">&nbsp;</label>
                            <button type="submit" class="btn btn-md btn-primary">View</button>
                        </div>
                        <div class="col-lg-2">
                            <label for="">&nbsp;</label><br>
                            <a href="{{ route('export', ['tgl1' => $tgl1, 'tgl2' => $tgl2, 'jenis' => $jenis]) }}"
                                target="_blank" class="btn btn-md btn-success"><i
                                    class="fa fa-file-pdf"></i> Export</a>
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
                @if ($jenis == 'absen')
                    <table class="table mb-5">
                        <thead class="thead-light">
                            <tr>
                                <th width="10">#</th>
                                <th>Nama</th>
                                <th>Posisi</th>
                                <th>M</th>
                                <th>I</th>
                                <th>S</th>
                                <th>OFF</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hasil as $h)
                            @php
                                $ttl = $h->ttl_absen_m + $h->ttl_absen_i + $h->ttl_absen_s + $h->ttl_absen_off;
                            @endphp
                            @if ($ttl != 0)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $h->nm_karyawan }}</td>
                                <td>{{ $h->posisi }}</td>
                                <td>{{ $h->ttl_absen_m ? $h->ttl_absen_m : 0 }}</td>
                                <td>{{ $h->ttl_absen_i ? $h->ttl_absen_i : 0 }}</td>
                                <td>{{ $h->ttl_absen_s ? $h->ttl_absen_s : 0 }}</td>
                                <td>{{ $h->ttl_absen_off ? $h->ttl_absen_off : 0 }}</td>
                                @php
                                    $dataGet = [
                                        'tgl1' => $tgl1,
                                        'tgl2' => $tgl2,
                                        'id_karyawan' => $h->id,
                                        'nama' => $h->nm_karyawan,
                                        'posisi' => $h->posisi
                                    ]
                                @endphp
                                <td>
                                    <a target="_blank" href="{{ route('printAbsen', $dataGet) }}" class="btn btn-primary btn-sm"><i class="fa fa-print"></i></a>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th width="10">#</th>
                                <th>Nama</th>
                                <th>Posisi</th>
                                <th>Gaji /hari</th>
                                <th>Absen M</th>
                                <th>TTL</th>
                                <th><span class="text-danger">Denda / Kasbon</span></th>
                                <th>Total Gaji</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hasil as $g)
                                @php
                                    $denda = DB::selectOne("SELECT sum(a.jumlah) as jumlah FROM tb_denda as a
                                    left JOIN tb_gaji as b on a.id_karyawan = b.id_karyawan
                                    WHERE a.tgl BETWEEN '$tgl1' AND '$tgl2' AND a.id_karyawan = '$g->id' 
                                    GROUP BY a.id_karyawan");
                                    $jmlDenda = $denda == '' ? 0 : $denda->jumlah;
                                    
                                    $kasbon = DB::selectOne("SELECT sum(a.jumlah) as jumlah FROM tb_kasbon as a
                                    left JOIN tb_gaji as b on a.id_karyawan = b.id_karyawan
                                    WHERE a.tgl BETWEEN '$tgl1' AND '$tgl2' AND a.id_karyawan = '$g->id'
                                    GROUP BY a.id_karyawan");
                                    $jmlKasbon = $kasbon == '' ? 0 : $kasbon->jumlah;
                                    $totalTotal = $g->ttl_gaji - $jmlDenda - $jmlKasbon;
                                @endphp
                                @if ($g->ttl_absen_m == 0)
                                @php
                                    continue;
                                @endphp
                                @else
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $g->nm_karyawan }}</td>
                                    <td>{{ $g->posisi }}</td>
                                    <td>{{ number_format($g->rp_gaji, 0) }}</td>
                                    <td>{{ $g->ttl_absen_m == 0 ? 0 : $g->ttl_absen_m }}</td>
                                    <td>{{ number_format($g->rp_gaji * $g->ttl_absen_m, 0) }}</td>
                                    <td><span class="text-danger">(
                                            {{ number_format($jmlDenda, 0) }} / {{ number_format($jmlKasbon, 0) }}
                                            )</span></td>
                                    <td>{{ number_format($totalTotal, 0) }} </td>
                                    <td>
                                        <a href="{{ route('kwitansiGaji', ['nama' => $g->nm_karyawan, 'total' => $totalTotal, 'tgl1' => $tgl1, 'tgl2' => $tgl2,'jabatan' => $g->posisi,'denda' =>$jmlDenda, 'kasbon' => $jmlKasbon]) }}" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-print"></i></a>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                @endif

            </div>
        </div>

    </div>




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
