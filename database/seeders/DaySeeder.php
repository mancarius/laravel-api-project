<?php

namespace Database\Seeders;

use App\Models\Day;
use Illuminate\Database\Seeder;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Day::insert([
            [
                'name' => 'sunday',
            ],
            [
                'name' => 'monday',
            ],
            [
                'name' => 'tuesday',
            ],
            [
                'name' => 'wednesday',
            ],
            [
                'name' => 'thursday',
            ],
            [
                'name' => 'friday',
            ],
            [
                'name' => 'saturday',
            ]
        ]);
    }
}
