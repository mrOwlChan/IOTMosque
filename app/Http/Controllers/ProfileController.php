<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Userdetail;
use App\Models\Userlevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Ambil data id user yang sedang sign-in simpan di $user
        $id = auth()->user()->id;

        // Ambil data userdetais yang berelasi dengan table user
        $user = User::find($id);

        // return ke view dengan data $user
        return view('profile.index', ['user' => $user]);
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('profile.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // Proses validasi input data user
        $validated = $request->validate([
            'name'      => 'required',
            'email'     => ['required','email:rfc,dns'],
            'telp'      => 'required',
            'birth'     => 'required',
            'address'   => 'required'
        ]);

        // Encrypt Password
        if($request['password'] != ''){
            // Proses encrypt password dengan Hash Table Laravel
            $validated['password'] = Hash::make($request['password']);

            // Proses Update field password di table users
            User::where('id', $user->id)->update([
                'password'  => $validated['password']
            ]);
        };

        // Proses Update field name dan email di table users
        User::where('id', $user->id)->update([
            'name'  => $validated['name'],
            'email' => $validated['email'],
        ]);

        Userdetail::where('user_id', $user->id)->update([
            'telp'      => $request['telp'],
            'birth'     => $request['birth'],
            'address'   => $request['address']
        ]);

        return redirect('/profile')->with('success', 'Data Profil Anda berhasil diperbaharui!');
    }

    public function updatePhoto(Request $request, User $user){
        // Proses validasi input data image
        $validated = $request->validate([
            'photo' => ['image','file','max:3072'] // dalam satuan kB (1 MB = 1024 kB)
        ]);

        // Hapus photo sebelumnya jika ada
        if ($request->prevPhoto != ''){
            Storage::delete($request->prevPhoto);

            // Kosongkan field photo pada table userdetails sesuai user id
            Userdetail::where('user_id', $user->id)->update([
                'photo' => ''
            ]);
        }

        // Nama Folder tempat menyimpan gambar adalah sesuai email user
        $validated = $request->file('photo')->store('users/'.$user->email.'/images');

        Userdetail::where('user_id', $user->id)->update([
            'photo' => $validated
        ]);

        return redirect('/profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        // Proses validasi password
        $credential = $request->validate([
            'passwordDelAccount' => 'required'
        ]);

        if ($credential = $user->password) {
            // Hapus folder data user di server
            Storage::deleteDirectory('users/'.$user->email);

            // Delete data user dan userdetails di database yang saling terkait 
            Userdetail::destroy($user->userdetail->id);
            User::destroy($user->id);

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
}
