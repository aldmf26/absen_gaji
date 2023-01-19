<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{

    public function index()
    {
        $data = [
            'title' => 'Data Karyawan',
            'karyawan' => Karyawan::orderBy('id', 'desc')->get(),
        ];
        return view('karyawan.karyawan', $data);
    }


    public function tambahKaryawan(Request $r)
    {

        $data = [
            'nm_karyawan' => $r->nm_karyawan,
            'tgl_masuk' => $r->tgl_masuk,
            'posisi' => $r->posisi,
            'alamat' => $r->alamat,
            'no_hp' => $r->no_hp,
        ];
        Karyawan::create($data);

        User::create([
            'name' => $r->nm_karyawan,
            'username' => $r->username,
            'password' => bcrypt($r->password),
            'role_id' => 3,
        ]);

        return redirect()->route('karyawan')->with('success', 'Berhasil tambah karyawan');
    }

    public function editKaryawan(Request $r)
    {
        $kr = Karyawan::where('id', $r->id)->first();
        $id_user = User::where('name', $kr->nm_karyawan)->first();
        
        $data = [
            'nm_karyawan' => $r->nm_karyawan,
            'tgl_masuk' => $r->tgl_masuk,
            'posisi' => $r->posisi,
            'alamat' => $r->alamat,
            'no_hp' => $r->no_hp,
        ];
        Karyawan::where('id', $r->id)->update($data);
        User::where('id', $id_user->id)->update(['name' => $r->nm_karyawan]);
        return redirect()->route('karyawan')->with('success', 'Berhasil edit karyawan');
    }

    public function hapusKaryawan(Request $r)
    {
        Karyawan::where('id', $r->id)->delete();
        return redirect()->route('karyawan')->with('error', '  Berhasil hapus karyawan');
    }
}
