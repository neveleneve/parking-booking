<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::create([
            'name' => 'Pandu',
            'email' => 'pandu@gmail.com',
            'password' => Hash::make('vdpandu123'),
            'level' => '0',
        ]);
        User::create([
            'name' => 'Pandu',
            'email' => 'pendu@gmail.com',
            'password' => Hash::make('vdpandu123'),
            'level' => '1',
        ]);
    }
}
