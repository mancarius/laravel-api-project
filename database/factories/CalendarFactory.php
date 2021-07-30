<?php

namespace Database\Factories;

use App\Models\Calendar;
use App\Models\Day;
use App\Models\Waste;
use Illuminate\Database\Eloquent\Factories\Factory;

class CalendarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Calendar::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $start_date = $this->faker->dateTimeBetween('2000-01-01 07:00:00', '2000-01-01 18:00:00');
        return [
            'day_id' => Day::inRandomOrder()->first()->id,
            'waste_id' => Waste::inRandomOrder()->first()->id,
            'time_start' => $start_date->format('H:00:00'),
            'time_interval' => 3600
        ];
    }
}
