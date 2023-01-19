<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(Request $r)
    {
        $data = [
            'title' => 'Login Page'
        ];
        return view('login.login', $data);
    }

    public function prosesLogin(Request $r)
    {
        $data = [
            'username' => $r->username,
            'password' => $r->password,
        ];
        if (Auth::attempt($data)) {
            $r->session()->regenerate();

            return redirect()->intended('welcome');
        } else {

            return redirect()->route('login')->with('error', 'Username / password salah!');
        }
    }

    public function logout(Request $r)
    {
        Auth::logout();

        $r->session()->invalidate();

        $r->session()->regenerateToken();

        return redirect('login');
    }
}
