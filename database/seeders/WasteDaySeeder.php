<?php

namespace Database\Seeders;

use App\Models\WasteDay;
use Illuminate\Database\Seeder;

class WasteDaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WasteDay::factory(10)->create();
    }
}