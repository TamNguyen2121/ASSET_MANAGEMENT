<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Allocation>
 */
class AllocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'equipment_id' => fake()->numberBetween(1, 200),
            'object' => fake()->numberBetween(1, 0),
            'reciver_id' => fake()->numberBetween(1, 100),
            'created_by' => fake()->numberBetween(1, 100),
        ];
    }
}
