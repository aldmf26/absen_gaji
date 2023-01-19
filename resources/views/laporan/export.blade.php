@include('laporan.template.header')
@if ($jenis == 'absen')
    <table class="table table-bordered">
        <thead style="background:#bedeee">
            <tr class="tr-title" style="font-weight: bold;color: #000;font-size: 9pt;">
                <th width="15">No.</th>
                <th>Nama</th>
                <th>Posisi</th>
                <th>M</th>
                <th>I</th>
                <th>S</th>
                <th>OFF</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($hasil as $h)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $h->nm_karyawan }}</td>
                    <td>{{ $h->posisi }}</td>
                    <td>{{ $h->ttl_absen_m ? $h->ttl_absen_m : 0 }}</td>
                    <td>{{ $h->ttl_absen_i ? $h->ttl_absen_i : 0 }}</td>
                    <td>{{ $h->ttl_absen_s ? $h->ttl_absen_s : 0 }}</td>
                    <td>{{ $h->ttl_absen_off ? $h->ttl_absen_off : 0 }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <table class="table table-bordered">
        <thead style="background:#bedeee">
            <tr class="tr-title" style="font-weight: bold;color: #000;font-size: 9pt;">
                <th width="15">No.</th>
                <th>Nama</th>
                <th>Posisi</th>
                <th>Gaji /hari</th>
                <th>Absen M</th>
                <th>TTL</th>
                <th><span class="text-danger">Denda / Kasbon</span></th>
                <th>Total Gaji</th>
            </tr>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
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
            
        @endphp
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
                    <td>{{ number_format($g->ttl_gaji - $jmlDenda - $jmlKasbon, 0) }} </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif


@include('laporan.template.footer')
