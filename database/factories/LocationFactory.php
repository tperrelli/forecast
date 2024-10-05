<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'city' => fake()->city,
            'country' => fake()->country,
            'lat' => fake()->latitude,
            'lng' => fake()->longitude,
            'weather' => array_rand(['cloud', 'sunny']),
            'weather_description' => fake()->text,
            'weather_icon' => fake()->image(),
            'temp_min' => rand(-20, 50),
            'temp_max' => rand(40, 60),
            'user_id' => User::factory(),
        ];
    }
}
