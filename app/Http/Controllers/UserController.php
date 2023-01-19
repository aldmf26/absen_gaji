<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $r)
    {
        if (Auth::user()->role_id == 3) {
            $user = User::where('name', Auth::user()->name)->get();
        } else {
            $user = User::all();
        }
        $data = [
            'title' => 'Data User',
            'user' => $user,
        ];
        return view('user.user', $data);
    }

    public function tambahUser(Request $r)
    {
        User::create([
            'name' => $r->name,
            'username' => $r->username,
            'password' => bcrypt($r->password),
            'role_id' => $r->role_id,
        ]);
        return redirect()->route('user')->with('success', 'Berhasil tambah user');
    }

    public function hapusUser(Request $r)
    {
        User::where('id', $r->id)->delete();
        return redirect()->route('user')->with('error', 'Berhasil hapus user');
    }
}
