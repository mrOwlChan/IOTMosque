<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Userlevel;
use App\Models\Userdetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // userlevel table
        Userlevel::create([
            'level' => 'Admin',
            'desc'  => ''
        ]);

        Userlevel::create([
            'level' => 'Editor',
            'desc'  => ''
        ]);

        Userlevel::create([
            'level' => 'Public',
            'desc'  => ''
        ]);

        // user table
        User::create([
            'name'          => 'Teguh Wijoseno',
            'email'         => 'mr.wijoseno@gmail.com',
            'password'      => Hash::make('123')
        ]);

        // userdetails table
        Userdetail::create([
            'enablestatus'  => '1',
            'user_id'       => '1',
            'userlevel_id'  => '1',
            'photo'         => '',
            'telp'          => '+6287888570877',
            'birth'         => '1988-12-23',
            'address'       => 'Jl. Sasak Batu no.45, Bandung'
        ]); 
    }
}
