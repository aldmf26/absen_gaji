@include('laporan.template.header')
<table class="table table-bordered">
    <thead style="background:#bedeee">
        <tr class="tr-title" style="font-weight: bold;color: #000;font-size: 9pt;">
            <th width="15">#</th>
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
@include('laporan.template.footer')
