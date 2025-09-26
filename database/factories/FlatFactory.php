<?php

namespace Database\Factories;

use App\Models\Building;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Flat>
 */
class FlatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $building = Building::inRandomOrder()->first();

        return [
            'building_id' => $building->id,
            'owner_id' => $building->owner_id,
            'flat_number' => strtoupper($this->faker->bothify('A-##')),
            'flat_owner_name' => fake()->name(),
            'flat_owner_phone' => fake()->phoneNumber(),
        ];
    }
}
