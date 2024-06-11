<?php

namespace Database\Seeders;

use App\Models\Slot;
use Illuminate\Database\Seeder;

class SlotSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $token = [
            'rla60fx56p',
            '89wok9brzb',
        ];
        for ($i = 1; $i <= 2; $i++) {
            Slot::create([
                'name' => 'Slot ' . $i,
                'token' => $token[$i - 1],
                'is_booked' => false,
                'booking_date' => null,
                'status_pakai' => '0',
                'status' => $i == 2 ? '0' : '1',
            ]);
        }
    }
}
