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
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'carta',
                'description' => 'description',
                'allowed' => json_encode([]),
                'not_allowed' => json_encode([]),
                'color' => '#0000FF',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'plastica',
                'description' => 'description',
                'allowed' => json_encode([]),
                'not_allowed' => json_encode([]),
                'color' => '#FFFF00',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'organico',
                'description' => 'description',
                'allowed' => json_encode([]),
                'not_allowed' => json_encode([]),
                'color' => '#AF593E',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'metalli',
                'description' => 'description',
                'allowed' => json_encode([]),
                'not_allowed' => json_encode([]),
                'color' => '#40E0D0',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'secco',
                'description' => 'description',
                'allowed' => json_encode([]),
                'not_allowed' => json_encode([]),
                'color' => '#808080',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
