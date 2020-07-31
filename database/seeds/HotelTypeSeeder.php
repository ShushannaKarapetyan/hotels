<?php

use App\HotelType;
use Illuminate\Database\Seeder;

class HotelTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();

        $hotelTypes = [
            [
                'type' => 'Hotel',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'type' => 'Pension',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'type' => 'Private Room',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'type' => 'AirBnb',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        HotelType::insert($hotelTypes);
    }
}
