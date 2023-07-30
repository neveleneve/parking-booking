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
        for ($i = 1; $i <= 10; $i++) {
            $rand = rand(0, 1);
            Slot::create([
                'name' => 'Slot ' . $i,
                'is_booked' => $rand ? true : false,
                'booking_date' => $rand ? '2023-07-30' : null,
            ]);
        }
    }
}
