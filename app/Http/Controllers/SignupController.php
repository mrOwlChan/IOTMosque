<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Signup;
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

        // Proses input data ke database
        User::create($validated);

        // Redirect ke halaman Login jika proses signin berhasil
        return redirect('/signin')->with('success', 'Selamat! Proses SignUp berhasil! Silahkan SignIn');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Signup  $signup
     * @return \Illuminate\Http\Response
     */
    public function show(Signup $signup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Signup  $signup
     * @return \Illuminate\Http\Response
     */
    public function edit(Signup $signup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Signup  $signup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Signup $signup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Signup  $signup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Signup $signup)
    {
        //
    }
}
