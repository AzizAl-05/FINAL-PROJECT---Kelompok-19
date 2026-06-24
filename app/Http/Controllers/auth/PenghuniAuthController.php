<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Penghuni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenghuniAuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'nama'     => 'required|string|max:255',
            'email'    => 'required|email|unique:penghuni,email',
            'no_telp'  => 'required|string|max:20',
            'kampus'   => 'nullable|string|max:255',
            'jurusan'  => 'nullable|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $penghuni = Penghuni::create([
            'nama'     => $validated['nama'],
            'email'    => $validated['email'],
            'no_telp'  => $validated['no_telp'],
            'kampus'   => $validated['kampus'] ?? null,
            'jurusan'  => $validated['jurusan'] ?? null,
            'password' => $validated['password'],
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login dengan akun baru Anda.');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::guard('penghuni')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('daftarkamar'));
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('penghuni')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

