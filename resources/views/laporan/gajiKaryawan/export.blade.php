@include('laporan.template.header')
<table class="table table-bordered">
    <thead style="background:#bedeee">
        <tr class="tr-title text-center" style="font-weight: bold;color: #000;font-size: 9pt;">
            <th width="15">No</th>
            <th align="center">Nama</th>
            <th align="center">Posisi</th>
            <th align="center">Gaji</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
        @endphp
        @foreach ($gaji as $k)
            <tr>
                <td align="center">{{ $no++ }}</td>
                <td align="center">{{ $k->nm_karyawan }}</td>
                <td align="center">{{ $k->posisi }}</td>
                <td align="center">{{ number_format($k->rp_gaji, 0) }}</td>

            </tr>
        @endforeach
    </tbody>
</table>
@include('laporan.template.footer')
