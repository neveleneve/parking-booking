<?php

namespace Database\Seeders;

use App\Models\Saldo;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        // admin
        User::create([
            'name' => 'Gerry',
            'email' => 'gerry@gmail.com',
            'password' => Hash::make('12345678'),
            'level' => '0',
        ]);
        // customer
        $data = User::create([
            'name' => 'Gerri',
            'email' => 'gerri@gmail.com',
            'password' => Hash::make('12345678'),
            'level' => '1',
        ]);
        Saldo::create([
            'user_id' => $data->id,
            'credit' => 50000,
        ]);
    }
}
