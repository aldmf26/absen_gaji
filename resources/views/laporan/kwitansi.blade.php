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
        <tr>
            <td width="40%">Status</td>
            <td width="10%">:</td>
            <td>Karyawan Tetap</td>
        </tr><br><br>
        
    </table><br><hr>
    <table cellpadding="5">
        <tr>
            <td width="75%"><b><u>Penghasilan</u></b></td>
        </tr>
        <tr>
            <td >Total Gaji</td>
            <td >Rp. {{ number_format($total + $denda + $kasbon,0) }}</td>
        </tr>
        <tr>
            <td width="75%"><b><u>Potongan</u></b></td>
        </tr>
        <tr>
            <td >Denda</td>
            <td >Rp. {{ number_format($denda,0) }}</td>
            
        </tr>
        <tr>
            <td >Kasbon</td>
            <td >Rp. {{ number_format($kasbon,0) }}</td>
        </tr>
        <tr class="bg-success text-white">
            <td><b><u>TOTAL</u></b></td>
            <td><b><u>Rp. {{ number_format($total) }}</u></b></td>
        </tr>
    </table>
</div>
<div id="footer-tanggal" style="margin-top: -150px;">
    Banjarmasin, <?php echo tgl_indo(date('Y-m-d')); ?>
</div>
<div id="footer-jabatan">
    Kepala Koperasi
</div>

<div id="footer-nama">
    Aftahuddin
</div>
</div>
</body>

</html><!-- Akhir halaman HTML yang akan di konvert -->
<script>
    window.print()
</script>
