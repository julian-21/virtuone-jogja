<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class LoginController extends Controller
{
    public function sagutepmasuk()
    {
        return view('auth.login');
    }

    public function sagutep(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/index'); // Ganti '/dashboard' dengan URL tujuan setelah login berhasil
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect('/sagutep');
    }
}
