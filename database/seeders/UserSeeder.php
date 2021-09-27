<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<15; $i++){
            User::create([
                'name' => 'user'.$i,
                'username' => 'username'.$i,
                'password' =>  Hash::make('password'.$i),
                'remember_token' => Str::random(10),
                'role_id' => 2
            ]);
        }
        for($i=1; $i<5; $i++){
            User::create([
                'name' => 'admin'.$i,
                'username' => 'adminUsername'.$i,
                'password' =>  Hash::make('password'.$i),
                'remember_token' => Str::random(10),
                'role_id' => 1
            ]);
        }
    }
}
