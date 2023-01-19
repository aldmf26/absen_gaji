@include('laporan.template.header')
<table class="table table-bordered">
    <thead style="background:#bedeee">
        <tr class="tr-title" style="font-weight: bold;color: #000;font-size: 9pt;">
            <th width="15">No.</th>
            <th>Nama</th>
            <th>Total</th>
            <th>Jumlah</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
        @endphp
        @foreach ($kasbon as $k)
            <tr>
                <td align="center">{{ $no++ }}</td>
                <td>{{ $k->nm_karyawan }}</td>
                <td>{{ $k->ttl }}</td>
                <td>{{ number_format($k->jumlah, 0) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@include('laporan.template.footer')
