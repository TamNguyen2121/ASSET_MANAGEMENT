<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class supplierFactory extends Factory
{

    protected $model = \App\Models\supplier::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'code' => fake()->name(),
            'name' => fake()->name(),
            'address' => fake()->address(),
            'phone_number' => fake()->phoneNumber(),
            'status' => fake()->randomElement([0, 1]),
            'created_by' => fake()->numberBetween(1, 30),
            'code' => fake()->name(),
        ];
    }
}
