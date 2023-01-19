<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index(Request $r)
    {
        $data = [
            'title' => 'Status Absen',
            'status' => Status::orderBy('id_status', 'DESC')->get(),
        ];
        return view('status.status', $data);
    }

    public function tambahStatus(Request $r)
    {
        Status::create([
            'status' => $r->status,
            'ket' => $r->ket,
        ]);
        return redirect()->route('status')->with('success', 'Berhasil tambah status');
    }

    public function editStatus(Request $r)
    {
        Status::where('id_status', $r->id_status)->update(['status' => $r->status, 'ket' => $r->ket]);
        return redirect()->route('status')->with('success', 'Berhasil edit status');
    }

    public function hapusStatus(Request $r)
    {
        Status::where('id_status', $r->id_status)->delete();
        return redirect()->route('status')->with('error', 'Berhasil hapus status');
    }
}
