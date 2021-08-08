<?php

namespace Database\Factories;

use App\Models\WasteDay;
use App\Models\Day;
use App\Models\Waste;
use Illuminate\Database\Eloquent\Factories\Factory;

class WasteDayFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WasteDay::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $start_date = $this->faker->dateTimeBetween('2000-01-01 07:00:00', '2000-01-01 18:00:00');
        $end_date = $start_date;
        return [
            'key' => $this->generateRandomKey(),
            'day_id' => Day::inRandomOrder()->first()->id,
            'waste_id' => Waste::inRandomOrder()->first()->id,
            'pick_up_time_start' => $start_date->format('H:00:00'),
            'pick_up_time_end' => $end_date->add(new \DateInterval('PT120M'))->format('H:00:00')
        ];
    }

    private function generateRandomKey($ln = 20) {
        $bytes = random_bytes($ln);
        return bin2hex($bytes);
    }
}
