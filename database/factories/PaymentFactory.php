<?php

namespace Database\Factories;

use App\Models\Bill;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'bill_id'       => Bill::inRandomOrder()->value('id'),
            'amount'        => $this->faker->numberBetween(500, 5000),
            'paid_at'       => $this->faker->dateTimeBetween('-2 months', 'now'),
            'reference'     => $this->faker->randomElement(['cash','bank','bkash','nagad','card']),
        ];
    }
}
