@include('laporan.template.header')
<h5 style="font-size: 15px; margin-top: -20px;">Periode {{ date('d-m-Y', strtotime($tgl1)) }} ~ {{ date('d-m-Y', strtotime($tgl2)) }}</h5>
<div class="container">
    <table cellpadding="6" style="margin-top: -20px;">
        <tr>
            <td width="40%">Nama</td>
            <td width="10%">:</td>
            <td>{{ ucwords($nama) }}</td>
        </tr>
        <tr >
            <td width="40%">Posisi</td>
            <td width="10%">:</td>
            <td>{{ ucwords($posisi) }}</td>
        </tr>

        
    </table><br><hr>
    <table class="table table-bordered">
        <thead style="background:#bedeee">
            <tr class="tr-title text-center" style="font-weight: bold;color: #000;font-size: 9pt;">
                <th width="15">No</th>
                <th align="center">Tanggal</th>
                <th align="center">Jam Masuk</th>
                <th align="center">Jam Keluar</th>
                <th align="center">Keterangan</th>
                <th align="center">Lokasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detail as $no => $k)
                <tr>
                    <td align="center">{{ $no+1 }}</td>
                    <td align="center">{{ $k->tgl }}</td>
                    <td align="center">{{ $k->jam_masuk }}</td>
                    <td align="center">{{ $k->jam_keluar }}</td>
                    <td align="center">{{ $k->status }}</td>
                    <td align="center">{{ $k->nm_gudang }}</td>
    
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@include('laporan.template.footer')