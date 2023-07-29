<?php

namespace Database\Seeders;

use App\Models\Saldo;
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
        // admin
        User::create([
            'name' => 'Pandu',
            'email' => 'pandu@gmail.com',
            'password' => Hash::make('vdpandu123'),
            'level' => '0',
        ]);
        // customer
        $data = User::create([
            'name' => 'Pandu',
            'email' => 'pendu@gmail.com',
            'password' => Hash::make('vdpandu123'),
            'level' => '1',
        ]);
        Saldo::create([
            'user_id' => $data->id,
            'credit' => 0,
        ]);
    }
}
