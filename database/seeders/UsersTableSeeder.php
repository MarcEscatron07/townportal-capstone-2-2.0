<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usernames = array('exardiah','lanceria','vivienne');

        $directories = array('images/profile/'.$usernames[0].'/',
        'images/profile/'.$usernames[1].'/',
        'images/profile/'.$usernames[2].'/');

        DB::table('users')->insert([
            [
                'username' => $usernames[0], 
                'firstname' => 'Marc Benedict', 
                'lastname' => 'Escatron', 
                'email' => 'marc.escatron07@gmail.com', 
                'password' => Hash::make('tpowner'), 
                'image' => $directories[0].'owner.jpg',
                'user_role_id' => 1
            ],
            [
                'username' => $usernames[1], 
                'firstname' => 'Joshua', 
                'lastname' => 'Alarva', 
                'email' => 'exaltria.mbe@gmail.com', 
                'password' => Hash::make('tpmanager'), 
                'image' => $directories[1].'maintainer.jpg',
                'user_role_id' => 2
            ],
            [
                'username' => $usernames[2], 
                'firstname' => 'Vivienne', 
                'lastname' => 'Felt', 
                'email' => 'felt@gmail.com', 
                'password' => Hash::make('tpstaff'), 
                'image' => $directories[2].'staff.png',
                'user_role_id' => 3
            ]
        ]);
    }
}
