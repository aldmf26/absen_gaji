@include('laporan.template.header')
<table class="table table-bordered">
    <thead style="background:#bedeee">
        <tr class="tr-title" style="font-weight: bold;color: #000;font-size: 9pt;">
            <th width="15">No.</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>No Hp</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
        @endphp
        @foreach ($lokasi as $k)
            <tr>
                <td align="center">{{ $no++ }}</td>
                <td>{{ $k->nm_gudang }}</td>
                <td>{{ $k->alamat }}</td>
                <td>{{ $k->no_hp }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@include('laporan.template.footer')
