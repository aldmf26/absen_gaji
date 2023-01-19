@include('laporan.template.header')
<table class="table table-bordered">
    <thead style="background:#bedeee">
        <tr class="tr-title" style="font-weight: bold;color: #000;font-size: 9pt;">
            <th width="15">No.</th>
            <th>Nama</th>
            <th>Tanggal Masuk</th>
            <th>Alamat</th>
            <th>No Hp</th>
            <th>Posisi</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
        @endphp
        @foreach ($karyawan as $k)
            <tr>
                <td>{{ $no++ }}</td>
                <td>
                    {{ $k->nm_karyawan }}</td>
                <td>{{ $k->tgl_masuk }}</td>
                <td>{{ $k->alamat }}</td>
                <td>{{ $k->no_hp }}</td>
                <td>{{ $k->posisi }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@include('laporan.template.footer')
