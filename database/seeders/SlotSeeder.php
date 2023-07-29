<?php

namespace Database\Seeders;

use App\Models\Slot;
use Illuminate\Database\Seeder;

class SlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Slot::create([
            'nama' => 'Parkir A110 Lantai Bawah',
            'token' => $this->randomString(10),
            'status' => '0',
        ]);
        Slot::create([
            'nama' => 'Parkir A120 Lantai Bawah',
            'token' => $this->randomString(10),
            'status' => '0',
        ]);
    }

    public function randomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $randomIndex = rand(0, strlen($characters) - 1);
            $string .= $characters[$randomIndex];
        }
        return $string;
    }
}
