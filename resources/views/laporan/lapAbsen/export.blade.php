@include('laporan.template.header')
<table class="table table-bordered">
    <thead style="background:#bedeee">
        <tr class="tr-title" style="font-weight: bold;color: #000;font-size: 9pt;">
            <th width="15">No.</th>
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
@include('laporan.template.footer')
