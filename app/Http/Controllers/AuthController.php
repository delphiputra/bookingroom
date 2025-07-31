<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // 🔹 Tampilkan halaman login
    public function showLogin()
    {
        // Jika sudah login, redirect sesuai role
        if (session()->has('user_id')) {
            if (session('user_role') === 'admin') {
                return redirect('/home');
            } else {
                return redirect('/user');
            }
        }

        return view('login');
    }

    // 🔹 Proses login manual via session
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            // Simpan info login ke session
            session([
                'user_id'   => $user->id,
                'user_name' => $user->name,
                'user_role' => $user->role,
            ]);

            // Redirect berdasarkan role
            return $user->role === 'admin'
                ? redirect('/home')
                : redirect('/user');
        }

        // Jika gagal login
        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    // 🔹 Logout
    public function logout()
    {
        session()->flush(); // Hapus semua data session
        return redirect('/login');
    }
}
