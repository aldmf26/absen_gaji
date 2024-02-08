<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Denda;
use App\Models\Gaji;
use App\Models\Karyawan;
use App\Models\Kasbon;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function view(Request $r)
    {
        $menu = $r->menu;

        if ($r->tgl1 == '') {
            $tgl1 = date('Y-m-1');
            $tgl2 = date('Y-m-d');
        } else {
            $tgl1 = $r->tgl1;
            $tgl2 = $r->tgl2;
        }
        // dd($menu);
        if ($menu == 'rGaji') {
            $title = 'Rekap Gaji';
            $jenis = 'gaji';
            $query = DB::select("SELECT a.*,SUM(d.qty_m) as ttl_absen_m,b.rp_gaji,SUM(d.qty_m * b.rp_gaji) as ttl_gaji FROM `karyawans` as a
            LEFT JOIN tb_gaji as b ON a.id = b.id_karyawan
            LEFT JOIN (SELECT c.id_karyawan, c.status, IF(c.status = 'M', COUNT(c.status),0) as qty_m FROM tb_absen as c WHERE c.tgl BETWEEN '$tgl1' AND '$tgl2' GROUP BY c.id_karyawan, c.status) as d on a.id = d.id_karyawan 
            GROUP BY a.id");
        } elseif ($menu == 'rAbsen') {
            $title = 'Rekap Absen';
            $jenis = 'absen';
            $query = DB::select("SELECT SUM(d.jam_masuk_count) as total_jam_masuk_count,
                                        SUM(d.jam_keluar_count) as total_jam_keluar_count,
                                        d.lembur as total_lembur,
                                        a.*,
                                        SUM(d.qty_m) as ttl_absen_m, 
                                        SUM(d.qty_i) as ttl_absen_i, 
                                        SUM(d.qty_s) as ttl_absen_s, 
                                        SUM(d.qty_off) as ttl_absen_off 
                                        FROM `karyawans` as a
            LEFT JOIN tb_gaji as b ON a.id = b.id_karyawan
            LEFT JOIN 
            (SELECT c.id_karyawan, c.status, 
             IF(c.status = 'M', COUNT(c.status),0) as qty_m,
             IF(c.status = 'I', COUNT(c.status),0) as qty_i,
             IF(c.status = 'S', COUNT(c.status),0) as qty_s,
              IF(c.status = 'OFF', COUNT(c.status),0) as qty_off,
              COUNT(IF(c.status = 'M' AND c.jam_masuk IS NOT NULL, 1, NULL)) as jam_masuk_count,
            COUNT(IF(c.status = 'M' AND c.jam_keluar IS NOT NULL, 1, NULL)) as jam_keluar_count,
            SUM(GREATEST(TIMESTAMPDIFF(HOUR, c.jam_masuk, c.jam_keluar) - 8, 0)) as lembur
             FROM tb_absen as c WHERE c.tgl BETWEEN '$tgl1' AND '$tgl2' GROUP BY c.id_karyawan, c.status) as d on a.id = d.id_karyawan 
                        GROUP BY a.id");
        }

        $data = [
            'title' => $title,
            'jenis' => $jenis,
            'menu' => $menu,
            'hasil' => $query,
            'tgl1' => $tgl1,
            'tgl2' => $tgl2,
        ];
        return view('laporan.view', $data);
    }

    public function rGajiKaryawan(Request $r)
    {
        if ($r->tgl1 == '') {
            $tgl1 = date('Y-m-1');
            $tgl2 = date('Y-m-d');
        } else {
            $tgl1 = $r->tgl1;
            $tgl2 = $r->tgl2;
        }
        $nama = Auth::user()->name;
        $query = DB::select("SELECT a.*,SUM(d.qty_m) as ttl_absen_m,b.rp_gaji,SUM(d.qty_m * b.rp_gaji) as ttl_gaji FROM `karyawans` as a
            LEFT JOIN tb_gaji as b ON a.id = b.id_karyawan
            LEFT JOIN (SELECT c.id_karyawan, c.status, IF(c.status = 'M', COUNT(c.status),0) as qty_m FROM tb_absen as c WHERE c.tgl BETWEEN '$tgl1' AND '$tgl2' GROUP BY c.id_karyawan, c.status) as d on a.id = d.id_karyawan WHERE a.nm_karyawan = '$nama' 
            GROUP BY a.id");
        $data = [
            'hasil' => $query,
            'tgl1' => $tgl1,
            'tgl2' => $tgl2,
            'title' => "Rekap gaji $nama",
        ];

        return view('gaji.viewGajiK', $data);
    }

    public function export(Request $r)
    {
        if ($r->tgl1 == '') {
            $tgl1 = date('Y-m-1');
            $tgl2 = date('Y-m-d');
        } else {
            $tgl1 = $r->tgl1;
            $tgl2 = $r->tgl2;
        }
        $jenis = $r->jenis;
        // dd($tgl1 . $tgl2 . $jenis);
        if ($jenis == 'gaji') {
            $title = 'Rekap Gaji';
            $jenis = 'gaji';
            $query = DB::select("SELECT a.*,SUM(d.qty_m) as ttl_absen_m,b.rp_gaji,SUM(d.qty_m * b.rp_gaji) as ttl_gaji FROM `karyawans` as a
            LEFT JOIN tb_gaji as b ON a.id = b.id_karyawan
            LEFT JOIN (SELECT c.id_karyawan, c.status, IF(c.status = 'M', COUNT(c.status),0) as qty_m FROM tb_absen as c WHERE c.tgl BETWEEN '$tgl1' AND '$tgl2' GROUP BY c.id_karyawan, c.status) as d on a.id = d.id_karyawan 
            GROUP BY a.id");
        } elseif ($jenis == 'absen') {
            $title = 'Rekap Absen';
            $jenis = 'absen';
            $query = DB::select("SELECT a.*,SUM(d.qty_m) as ttl_absen_m, SUM(d.qty_i) as ttl_absen_i, SUM(d.qty_s) as ttl_absen_s, SUM(d.qty_off) as ttl_absen_off FROM `karyawans` as a
            LEFT JOIN tb_gaji as b ON a.id = b.id_karyawan
            LEFT JOIN 
            (SELECT c.id_karyawan, c.status, 
             IF(c.status = 'M', COUNT(c.status),0) as qty_m,
             IF(c.status = 'I', COUNT(c.status),0) as qty_i,
             IF(c.status = 'S', COUNT(c.status),0) as qty_s,
              IF(c.status = 'OFF', COUNT(c.status),0) as qty_off
             FROM tb_absen as c WHERE c.tgl BETWEEN '$tgl1' AND '$tgl2' GROUP BY c.id_karyawan, c.status) as d on a.id = d.id_karyawan 
                        GROUP BY a.id");
        }

        $data = [
            'title' => $title,
            'jenis' => $jenis,
            'tgl1' => $tgl1,
            'tgl2' => $tgl2,
            'hasil' => $query,
        ];
        return view('laporan.export', $data);
    }

    public function laporanKaryawan(Request $r)
    {
        $data = [
            'title' => 'Laporan Karyawan',
            'gaji' => Gaji::join('karyawans', 'karyawans.id', 'tb_gaji.id_karyawan')->orderBy('tb_gaji.id_gaji', 'DESC')->get(),
            'karyawan' => Karyawan::all(),
        ];
        return view('laporan.gajiKaryawan.view', $data);
    }

    public function exportKaryawan(Request $r)
    {
        $data = [
            'title' => 'Laporan Rekap Gaji Karyawan',
            'gaji' => Gaji::join('karyawans', 'karyawans.id', 'tb_gaji.id_karyawan')->orderBy('tb_gaji.id_gaji', 'DESC')->get(),
            'karyawan' => Karyawan::all(),
        ];
        return view('laporan.gajiKaryawan.export', $data);
    }

    public function lapKaryawan(Request $r)
    {
        $data = [
            'title' => 'Laporan Karyawan',
            'karyawan' => Karyawan::orderBy('id', 'desc')->get(),

        ];
        return view('laporan.lapKaryawan.view', $data);
    }

    public function exportLapKaryawan(Request $r)
    {
        $data = [
            'title' => 'Laporan Karyawan',
            'karyawan' => Karyawan::orderBy('id', 'desc')->get(),

        ];
        return view('laporan.lapKaryawan.lap', $data);
    }

    public function laporanLokasi(Request $r)
    {
        $data = [
            'title' => 'Laporan Lokasi',
            'lokasi' => Lokasi::orderBy('id_lokasi', 'DESC')->get(),
        ];
        return view('laporan.lapLokasi.view', $data);
    }

    public function exportLaporanLokasi(Request $r)
    {
        $data = [
            'title' => 'Laporan Lokasi',
            'lokasi' => Lokasi::orderBy('id_lokasi', 'DESC')->get(),
        ];
        return view('laporan.lapLokasi.export', $data);
    }

    public function lapKasbon(Request $r)
    {
        if ($r->tgl1 == '') {
            $tgl1 = date('Y-m-1');
            $tgl2 = date('Y-m-d');
        } else {
            $tgl1 = $r->tgl1;
            $tgl2 = $r->tgl2;
        }
        $data = [
            'title' => 'Rekap Kasbon',
            'kasbon' => DB::select("SELECT a.tgl, b.nm_karyawan, sum(a.jumlah) as jumlah, COUNT(a.id_karyawan) as ttl  FROM `tb_kasbon` as a
            LEFT JOIN karyawans as b ON a.id_karyawan = b.id
            WHERE a.tgl BETWEEN '$tgl1' AND '$tgl2'
            GROUP BY a.id_karyawan"),
            'tgl1' => $tgl1,
            'tgl2' => $tgl2,
        ];

        return view('laporan.lapKasbon.view', $data);
    }

    public function exportLapKasbon(Request $r)
    {
        if ($r->tgl1 == '') {
            $tgl1 = date('Y-m-1');
            $tgl2 = date('Y-m-d');
        } else {
            $tgl1 = $r->tgl1;
            $tgl2 = $r->tgl2;
        }
        $data = [
            'title' => 'Rekap Kasbon',
            'kasbon' => DB::select("SELECT a.tgl, b.nm_karyawan, sum(a.jumlah) as jumlah, COUNT(a.id_karyawan) as ttl  FROM `tb_kasbon` as a
            LEFT JOIN karyawans as b ON a.id_karyawan = b.id
            WHERE a.tgl BETWEEN '$tgl1' AND '$tgl2'
            GROUP BY a.id_karyawan"),
            'tgl1' => $tgl1,
            'tgl2' => $tgl2,
        ];

        return view('laporan.lapKasbon.export', $data);
    }

    public function lapDenda(Request $r)
    {
        if ($r->tgl1 == '') {
            $tgl1 = date('Y-m-1');
            $tgl2 = date('Y-m-d');
        } else {
            $tgl1 = $r->tgl1;
            $tgl2 = $r->tgl2;
        }
        $data = [
            'title' => 'Rekap Ganti Rugi',
            'denda' => DB::select("SELECT a.tgl, b.nm_karyawan, sum(a.jumlah) as jumlah, COUNT(a.id_karyawan) as ttl  FROM `tb_denda` as a
            LEFT JOIN karyawans as b ON a.id_karyawan = b.id
            WHERE a.tgl BETWEEN '$tgl1' AND '$tgl2'
            GROUP BY a.id_karyawan"),
            'tgl1' => $tgl1,
            'tgl2' => $tgl2,
        ];
        return view('laporan.lapDenda.view', $data);
    }

    public function exportLapDenda(Request $r)
    {
        if ($r->tgl1 == '') {
            $tgl1 = date('Y-m-1');
            $tgl2 = date('Y-m-d');
        } else {
            $tgl1 = $r->tgl1;
            $tgl2 = $r->tgl2;
        }
        $data = [
            'title' => 'Rekap Ganti Rugi',
            'denda' => DB::select("SELECT a.tgl, b.nm_karyawan, sum(a.jumlah) as jumlah, COUNT(a.id_karyawan) as ttl  FROM `tb_denda` as a
            LEFT JOIN karyawans as b ON a.id_karyawan = b.id
            WHERE a.tgl BETWEEN '$tgl1' AND '$tgl2'
            GROUP BY a.id_karyawan"),
            'tgl1' => $tgl1,
            'tgl2' => $tgl2,
        ];

        return view('laporan.lapDenda.export', $data);
    }

    public function lapDataDenda(Request $r)
    {

        $data = [
            'title' => 'Laporan Ganti Rugi',
            'denda' => Denda::join('karyawans', 'tb_denda.id_karyawan', 'karyawans.id')->orderBy('tb_denda.id_denda', 'DESC')->get()
        ];
        return view('laporan.lapDenda.viewData', $data);
    }

    public function exportLapDataDenda(Request $r)
    {
        $data = [
            'title' => 'Laporan Ganti Rugi',
            'denda' => Denda::join('karyawans', 'tb_denda.id_karyawan', 'karyawans.id')->orderBy('tb_denda.id_denda', 'DESC')->get()
        ];

        return view('laporan.lapDenda.exportData', $data);
    }

    public function lapDataKasbon(Request $r)
    {
        $data = [
            'title' => 'Laporan Kasbon',
            'kasbon' => Kasbon::join('karyawans', 'tb_kasbon.id_karyawan', 'karyawans.id')->orderBy('tb_kasbon.id_kasbon', 'DESC')->get(),
        ];
        return view('laporan.lapKasbon.viewData', $data);
    }

    public function exportLapDataKasbon(Request $r)
    {
        $data = [
            'title' => 'Laporan Kasbon',
            'kasbon' => Kasbon::join('karyawans', 'tb_kasbon.id_karyawan', 'karyawans.id')->orderBy('tb_kasbon.id_kasbon', 'DESC')->get(),
        ];

        return view('laporan.lapKasbon.exportData', $data);
    }

    public function lapAbsen(Request $r)
    {
        if ($r->tgl1 == '') {
            $tgl1 = date('Y-m-1');
            $tgl2 = date('Y-m-d');
        } else {
            $tgl1 = $r->tgl1;
            $tgl2 = $r->tgl2;
        }
        $data = [
            'title' => 'Laporan Absensi',
            'absen' => Absen::join('karyawans', 'tb_absen.id_karyawan', 'karyawans.id')->join('tb_lokasi', 'tb_absen.id_lokasi', 'tb_lokasi.id_lokasi')->orderBy('tb_absen.tgl', 'ASC')->get(),
            'tgl1' => $tgl1,
            'tgl2' => $tgl2,
        ];

        return view('laporan.lapAbsen.view', $data);
    }

    public function exportLapAbsen(Request $r)
    {
        if ($r->tgl1 == '') {
            $tgl1 = date('Y-m-1');
            $tgl2 = date('Y-m-d');
        } else {
            $tgl1 = $r->tgl1;
            $tgl2 = $r->tgl2;
        }
        $data = [
            'title' => 'Laporan Absensi',
            'absen' => Absen::join('karyawans', 'tb_absen.id_karyawan', 'karyawans.id')->join('tb_lokasi', 'tb_absen.id_lokasi', 'tb_lokasi.id_lokasi')->orderBy('tb_absen.tgl', 'ASC')->get(),
            'tgl1' => $tgl1,
            'tgl2' => $tgl2,
        ];

        return view('laporan.lapAbsen.export', $data);
    }

    public function kwitansiGaji(Request $r)
    {
        $data = [
            'title' => 'Kwitansi Gaji Karyawan',
            'nama' => $r->nama,
            'total' => $r->total,
            'tgl1' => $r->tgl1,
            'tgl2' => $r->tgl2,
            'denda' => $r->denda,
            'kasbon' => $r->kasbon,
            'posisi' => $r->jabatan,
        ];
        return view('laporan.kwitansi', $data);
    }

    public function printAbsen(Request $r)
    {
        $detail = DB::table('tb_absen as a')->join('karyawans as b', 'a.id_karyawan', 'b.id')->join('tb_lokasi as c', 'a.id_lokasi', 'c.id_lokasi')->where('b.id', $r->id_karyawan)->whereBetween('tgl', [$r->tgl1, $r->tgl2])->get();

        $data = [
            'title' => 'Detail Absen',
            'tgl1' => $r->tgl1,
            'tgl2' => $r->tgl2,
            'detail' => $detail,
            'nama' => $r->nama,
            'posisi' => $r->posisi,
        ];

        return view('laporan.absenDetail', $data);
    }
}
