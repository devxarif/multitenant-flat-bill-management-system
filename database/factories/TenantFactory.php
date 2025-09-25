<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Building;
use App\Models\Flat;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tenant>
 */
class TenantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $building = Building::inRandomOrder()->first();
        $owner = $building->owner;

        return [
            'owner_id' => $owner->id,
            'building_id' => $building->id,
            'name' => fake()->name(),
            'email' => fake()->email(),
            'phone' => fake()->phoneNumber(),
        ];
    }
}
