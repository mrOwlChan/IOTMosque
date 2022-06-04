<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Userdetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SignupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.signup');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Proses validasi data
        $validated = $request->validate([
            'name'      => ['required', 'min:3', 'max:50'],
            'email'     => ['required', 'email:rfc,dns', 'unique:users'],
            'password'  => ['required', 'min:3', 'max:50'],
            'retype_password' => ['required', 'same:password']
        ]);

        // Proses encrypt password dengan fungsi php bcrypt
        // $validated['password'] = bcrypt( $validated['password']);

        // Proses encrypt password dengan Hash Table Laravel
        $validated['password'] = Hash::make($validated['password']);

        // Proses input data ke table users
        $user = User::create($validated);

        // Proses input data ke table userdetails yang terhubung ke table users
        Userdetail::create([
            'user_id'      => $user->id,
            'enablestatus' => '1',   
            'userlevel_id' => '3'    
        ]);

        // Redirect ke halaman Login jika proses signin berhasil
        return redirect('/signin')->with('success', 'Selamat! Proses SignUp berhasil! Silahkan SignIn');
    }
}
