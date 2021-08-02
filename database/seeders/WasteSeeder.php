<?php

namespace Database\Seeders;

use App\Models\Waste;
use Illuminate\Database\Seeder;

class WasteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Waste::insert([
            [
                'name' => 'vetro',
                'description' => 'description',
                'allowed' => json_encode([]),
                'not_allowed' => json_encode([]),
                'color' => '#008000',
            ],
            [
                'name' => 'carta',
                'description' => 'description',
                'allowed' => json_encode([]),
                'not_allowed' => json_encode([]),
                'color' => '#0000FF',
            ],
            [
                'name' => 'plastica',
                'description' => 'description',
                'allowed' => json_encode([]),
                'not_allowed' => json_encode([]),
                'color' => '#FFFF00',
            ],
            [
                'name' => 'organico',
                'description' => 'description',
                'allowed' => json_encode([]),
                'not_allowed' => json_encode([]),
                'color' => '#AF593E',
            ],
            [
                'name' => 'metalli',
                'description' => 'description',
                'allowed' => json_encode([]),
                'not_allowed' => json_encode([]),
                'color' => '#40E0D0',
            ],
            [
                'name' => 'secco',
                'description' => 'description',
                'allowed' => json_encode([]),
                'not_allowed' => json_encode([]),
                'color' => '#808080',
            ]
        ]);
    }
}
