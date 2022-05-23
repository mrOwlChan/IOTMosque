<?php

namespace App\Http\Controllers;

use App\Models\Signin;
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Signin  $signin
     * @return \Illuminate\Http\Response
     */
    public function show(Signin $signin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Signin  $signin
     * @return \Illuminate\Http\Response
     */
    public function edit(Signin $signin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Signin  $signin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Signin $signin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Signin  $signin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Signin $signin)
    {
        //
    }

    public function authenticate(Request $request){
        // Proses validasi data
        $credentials = $request->validate([
            'email'     => ['required', 'email:rfc,dns'],
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
