<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Karyawan;
use App\Models\Lokasi;
use App\Models\Status;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsenController extends Controller
{
    public function index(Request $r)
    {
        if (Auth::user()->role_id == 3) {
            $absen = Absen::join('karyawans', 'tb_absen.id_karyawan', 'karyawans.id')->join('tb_lokasi', 'tb_absen.id_lokasi', 'tb_lokasi.id_lokasi')->where('karyawans.nm_karyawan', Auth::user()->name)->orderBy('tb_absen.tgl', 'ASC')->get();
            $karyawan = Karyawan::where('nm_karyawan', Auth::user()->name)->get();
        } else {
            $absen = Absen::join('karyawans', 'tb_absen.id_karyawan', 'karyawans.id')->join('tb_lokasi', 'tb_absen.id_lokasi', 'tb_lokasi.id_lokasi')->orderBy('tb_absen.tgl', 'ASC')->get();
            $karyawan = Karyawan::all();
        }
        $data = [
            'title' => 'Absensi',
            'absen' => $absen,
            'karyawan' => $karyawan,
            'status' => Status::all(),
            'lokasi' => Lokasi::all(),
        ];
        return view('absen.absen', $data);
    }

    public function tambahAbsen(Request $r)
    {
        // dd($r->id_karyawan);
        $cek = Absen::where([['id_karyawan', $r->id_karyawan], ['tgl', $r->tgl]])->first();

        if ($cek) {
            return redirect()->route('absen')->with('error', 'Absen sudah ada');
        } else {
            Absen::create([
                'id_karyawan' => $r->id_karyawan,
                'status' => $r->status,
                'tgl' => $r->tgl,
                'jam_masuk' => $r->jam_masuk ?? now(),
                'jam_keluar' => $r->jam_keluar ?? now(),
                'id_lokasi' => $r->id_lokasi,
                'admin' => Auth::user()->name,
            ]);
            return redirect()->route('absen')->with('success', 'Berhasil tambah absen');
        }
    }

    public function editAbsen(Request $r)
    {
        Absen::where('id_absen', $r->id_absen)->update(['status' => $r->status]);
        return redirect()->route('absen')->with('success', 'Berhasil edit absen');
    }

    public function hapusAbsen(Request $r)
    {
        Absen::where('id_absen', $r->id_absen)->delete();
        return redirect()->route('absen')->with('error', 'Berhasil hapus status');
    }
}
