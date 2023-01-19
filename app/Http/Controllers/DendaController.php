<?php

namespace App\Http\Controllers;

use App\Models\Denda;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DendaController extends Controller
{
    public function index(Request $r)
    {
        if (Auth::user()->role_id == 3) {
            $denda = Denda::join('karyawans', 'tb_denda.id_karyawan', 'karyawans.id')->where('karyawans.nm_karyawan', Auth::user()->name)->orderBy('tb_denda.id_denda', 'DESC')->get();
        } else {
            $denda = Denda::join('karyawans', 'tb_denda.id_karyawan', 'karyawans.id')->orderBy('tb_denda.id_denda', 'DESC')->get();
        }
        $data = [
            'title' => 'Data Denda',
            'denda' => $denda,
            'karyawan' => Karyawan::all(),
        ];

        return view('denda.denda', $data);
    }

    public function tambahDenda(Request $r)
    {
        $cek = Denda::where([['id_karyawan', $r->id_karyawan], ['tgl', $r->tgl]])->first();
        if ($cek) {
            return redirect()->route('denda')->with('error', 'Data Sudah ada');
        } else {
            Denda::create([
                'id_karyawan' => $r->id_karyawan,
                'jumlah' => $r->jumlah,
                'ket' => $r->ket,
                'tgl' => $r->tgl,
            ]);
            return redirect()->route('denda')->with('success', 'Berhasil tambah denda');
        }
    }

    public function editDenda(Request $r)
    {
        $data = [
            'id_karyawan' => $r->id_karyawan,
            'jumlah' => $r->jumlah,
            'tgl' => $r->tgl,
            'ket' => $r->ket,
        ];
        Denda::where('id_denda', $r->id_denda)->update($data);
        return redirect()->route('denda')->with('success', 'Berhasil edit denda');
    }

    public function hapusDenda(Request $r)
    {
        Denda::where('id_denda', $r->id_denda)->delete();
        return redirect()->route('denda')->with('error', 'Berhasil hapus denda');
    }
}
