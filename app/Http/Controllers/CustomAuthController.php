<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class CustomAuthController extends Controller
{
    public function sagutepmasuk()
    {
        return view('auth.login');
    }

    public function sagutep(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->is_active === 'no') {
                Auth::logout(); // Log the user out if the account is not active
                return redirect()->back()->withErrors(['email' => 'Your account is not active.']);
            }

            if ($user->role === 'ADMIN') {
                return redirect()->intended('/index'); // Ganti '/admin' dengan URL tujuan admin setelah login berhasil
            } elseif ($user->role === 'PETUGAS') {
                return redirect()->intended('/index'); // Ganti '/petugas' dengan URL tujuan petugas setelah login berhasil
            } elseif ($user->role === 'VA') {
                return redirect()->intended('/index'); // Ganti '/va' dengan URL tujuan VA setelah login berhasil
            } else {
                return redirect()->intended('/index'); // URL default jika rolenya tidak cocok dengan yang diberikan
            }
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:ADMIN,VA,PETUGAS,USER', // Add other roles as needed
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Redirect to the desired page
        return redirect('/user-list'); // Change this to the desired route after successful registration
    }


    public function logout(Request $request)
    {
        Auth::logout();

        return redirect('sagutep');
    }
}
