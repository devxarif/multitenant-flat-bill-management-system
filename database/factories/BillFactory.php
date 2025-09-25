<?php

namespace Database\Factories;

use App\Models\Flat;
use App\Models\User;
use App\Models\Building;
use App\Enums\UserRoleEnum;
use App\Models\BillCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bill>
 */
class BillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $owner_id = User::where('role', UserRoleEnum::OWNER)->inRandomOrder()->value('id');
        $building_id = Building::where('user_id', $owner_id)->inRandomOrder()->value('id');
        $flat_id = Flat::where('building_id', $building_id)->inRandomOrder()->value('id');

        return [
            'owner_id'          => $owner_id,
            'building_id'       => $building_id,
            'flat_id'           => $flat_id,
            'bill_category_id'  => BillCategory::inRandomOrder()->value('id'),
            'month'             => fake()->month(),
            'amount'            => fake()->numberBetween(500, 5000),
            'carried_due'       => fake()->numberBetween(500, 5000),
            'total_due'         => fake()->numberBetween(500, 5000),
            'status'            => fake()->randomElement(['unpaid','paid','overdue']),
            'notes'             => fake()->paragraph(),
        ];
    }
}
