<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GajiController extends Controller
{
    public function index(Request $r)
    {
        if (Auth::user()->role_id == 3) {
            $gaji = Gaji::join('karyawans', 'karyawans.id', 'tb_gaji.id_karyawan')->where('karyawans.nm_karyawan', Auth::user()->name)->orderBy('tb_gaji.id_gaji', 'DESC')->get();
        } else {
            $gaji = Gaji::join('karyawans', 'karyawans.id', 'tb_gaji.id_karyawan')->orderBy('tb_gaji.id_gaji', 'DESC')->get();
        }
        $data = [
            'title' => 'Data Gaji Karyawan',
            'gaji' => $gaji,
            'karyawan' => Karyawan::all(),
        ];
        return view('gaji.gaji', $data);
    }

    public function tambahGaji(Request $r)
    {
        $cek = Gaji::where('id_karyawan', $r->id_karyawan)->first();

        if ($cek) {
            return redirect()->route('gaji')->with('error', 'Karyawan sudah ada gaji');
        } else {
            Gaji::create([
                'id_karyawan' => $r->id_karyawan,
                'rp_gaji' => $r->rp_gaji,
            ]);
            return redirect()->route('gaji')->with('success', 'Berhasil tambah gaji');
        }
    }

    public function editGaji(Request $r)
    {
        $data = [
            'id_karyawan' => $r->id_karyawan,
            'rp_gaji' => $r->rp_gaji,
        ];
        Gaji::where('id_gaji', $r->id_gaji)->update($data);
        return redirect()->route('gaji')->with('success', 'Berhasil edit gaji');
    }

    public function hapusGaji(Request $r)
    {
        Gaji::where('id_gaji', $r->id_gaji)->delete();
        return redirect()->route('gaji')->with('error', 'Berhasil hapus gaji');
    }
}
