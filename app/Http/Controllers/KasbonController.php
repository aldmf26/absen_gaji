<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Kasbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KasbonController extends Controller
{
    public function index(Request $r)
    {
        if (Auth::user()->role_id == 3) {
            $kasbon = Kasbon::join('karyawans', 'tb_kasbon.id_karyawan', 'karyawans.id')->where('karyawans.nm_karyawan', Auth::user()->name)->orderBy('tb_kasbon.id_kasbon', 'DESC')->get();
        } else {
            $kasbon = Kasbon::join('karyawans', 'tb_kasbon.id_karyawan', 'karyawans.id')->orderBy('tb_kasbon.id_kasbon', 'DESC')->get();
        }
        $data = [
            'title' => 'Data Kasbon',
            'kasbon' => $kasbon,
            'karyawan' => Karyawan::all(),
        ];

        return view('kasbon.kasbon', $data);
    }

    public function tambahKasbon(Request $r)
    {
        $cek = Kasbon::where([['id_karyawan', $r->id_karyawan], ['tgl', $r->tgl]])->first();
        if ($cek) {
            return redirect()->route('kasbon')->with('error', 'Data Sudah ada');
        } else {
            Kasbon::create([
                'id_karyawan' => $r->id_karyawan,
                'jumlah' => $r->jumlah,
                'ket' => $r->ket,
                'tgl' => $r->tgl,
            ]);
            return redirect()->route('kasbon')->with('success', 'Berhasil tambah kasbon');
        }
    }

    public function editKasbon(Request $r)
    {
        $data = [
            'id_karyawan' => $r->id_karyawan,
            'jumlah' => $r->jumlah,
            'tgl' => $r->tgl,
            'ket' => $r->ket,
        ];
        Kasbon::where('id_kasbon', $r->id_kasbon)->update($data);
        return redirect()->route('kasbon')->with('success', 'Berhasil edit kasbon');
    }

    public function hapusKasbon(Request $r)
    {
        Kasbon::where('id_kasbon', $r->id_kasbon)->delete();
        return redirect()->route('kasbon')->with('error', 'Berhasil hapus kasbon');
    }
}
