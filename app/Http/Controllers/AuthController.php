<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login.
     */
    public function showLogin()
    {
        return view('auth.login');
    }


    /**
     * Proses login.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => [
                'required',
                'string',
            ],
            'password' => [
                'required',
                'string',
            ],
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | CEK LOGIN
        |--------------------------------------------------------------------------
        */

        if (Auth::attempt([
            'username' => $credentials['username'],
            'password' => $credentials['password'],
        ])) {

            $request->session()->regenerate();


            /*
            |--------------------------------------------------------------------------
            | CEK ROLE
            |--------------------------------------------------------------------------
            */

            $user = Auth::user();


            if ($user->role === 'admin') {

                $message =
                    'Hi Admin, Selamat Datang di Aplikasi Percetakan Gemiprint!';

            } elseif ($user->role === 'desainer') {

                $message =
                    'Hi Desainer, Selamat Datang di Aplikasi Percetakan Gemiprint';

            } else {

                /*
                |--------------------------------------------------------------------------
                | ROLE TIDAK DIKENAL
                |--------------------------------------------------------------------------
                */

                Auth::logout();

                $request->session()->invalidate();

                $request->session()->regenerateToken();

                return redirect()
                    ->route('login')
                    ->with(
                        'error',
                        'Role pengguna tidak valid. Silakan hubungi administrator.'
                    );
            }


            /*
            |--------------------------------------------------------------------------
            | LOGIN BERHASIL
            |--------------------------------------------------------------------------
            */

            return redirect()
                ->route('dashboard')
                ->with('success', $message);
        }


        /*
        |--------------------------------------------------------------------------
        | LOGIN GAGAL
        |--------------------------------------------------------------------------
        */

        return back()
            ->withInput($request->only('username'))
            ->with(
                'error',
                'Username atau Password tidak sesuai periksa kembali.'
            );
    }


    /**
     * Proses logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();


        /*
        |--------------------------------------------------------------------------
        | HAPUS SESSION
        |--------------------------------------------------------------------------
        */

        $request->session()->invalidate();

        $request->session()->regenerateToken();


        /*
        |--------------------------------------------------------------------------
        | KEMBALI KE LOGIN
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('login')
            ->with(
                'success',
                'Anda berhasil logout.'
            );
    }
}