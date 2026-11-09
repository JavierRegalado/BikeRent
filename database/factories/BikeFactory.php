<?php

namespace Database\Factories;

use App\Models\Bike;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Bike>
 */
class BikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'serial_number' => $this->faker->unique()->regexify('[A-Z0-9]{10}'),
            'model' => $this->faker->word(),
            'price_per_hour' => $this->faker->randomFloat(2, 5, 50),
            'status' => $this->faker->randomElement(['available', 'retired', 'maintenance']),
        ];
    }
}
