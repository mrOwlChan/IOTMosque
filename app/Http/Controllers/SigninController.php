<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SigninController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.signin');
    }

    public function authenticate(Request $request){
        // Proses validasi data
        $credentials = $request->validate([
            'email'     => ['required', 'email'],
            // 'email'     => ['required', 'email:rfc,dns'],
            'password'  => ['required', 'min:3', 'max:50']
        ]);

        // Proses cek kesesuaian data input dengan data di database 
        if(Auth::attempt($credentials)){
            // Jika data input sesuai/sama dengan data di database
            $request->session()->regenerate();

            // Redirect ke halaman Home setelah signin berhasil
            return redirect()->intended('/'); // intended() akan melibatkan fitur middleware Laravel 
        }

        // Jika data input tidak sesuai atau tidak ada di database
        return redirect('/signin')->with('failed', "Gagal Sign In! Data yang Anda input salah!");

    }

    public function signout(Request $request){
        // Proses Sign Out
        Auth::logout();
 
        // Proses invalidasi session user untuk menghidari data session sebelumnya tidak bisa dipakai kembali
        $request->session()->invalidate();
     
        // Proses regerate atau membuat token baru
        $request->session()->regenerateToken();
     
        // Redirect ke home page setelah logout
        return redirect('/');

    }
}
