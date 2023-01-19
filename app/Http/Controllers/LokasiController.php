<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    public function index(Request $r)
    {
        $data = [
            'title' => 'Lokasi Gudang',
            'lokasi' => Lokasi::orderBy('id_lokasi', 'DESC')->get(),
        ];
        return view('lokasi.lokasi', $data);
    }

    public function tambahLokasi(Request $r)
    {
        Lokasi::create([
            'nm_gudang' => $r->nm_gudang,
            'alamat' => $r->alamat,
            'no_hp' => $r->no_hp,
        ]);
        return redirect()->route('lokasi')->with('success', 'Berhasil tambah lokasi');
    }

    public function editLokasi(Request $r)
    {
        $data = [
            'nm_gudang' => $r->nm_gudang,
            'alamat' => $r->alamat,
            'no_hp' => $r->no_hp,
        ];
        Lokasi::where('id_lokasi', $r->id_lokasi)->update($data);
        return redirect()->route('lokasi')->with('success', 'Berhasil edit lokasi');
    }

    public function hapusLokasi(Request $r)
    {
        Lokasi::where('id_lokasi', $r->id_lokasi)->delete();
        return redirect()->route('lokasi')->with('error', 'Berhasil hapus lokasi');
    }
}
