<?php

namespace Database\Seeders;

use App\Models\BookingTimeblock;
use Illuminate\Database\Seeder;

class BookingTimeblockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(0, 6) as $weekday) {
            BookingTimeblock::updateOrCreate(
                [
                    'weekday' => $weekday,
                    'start' => '09:00',
                    'end' => '18:00',
                ],
                [
                    'interval_minutes' => 30,
                ]
            );
        }
    }
}
