<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equipment>
 */
class EquipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomNumber = '';
        $length = 10;
        for ($i = 0; $i < $length; $i++) {
            $randomNumber .= mt_rand(0, 9);
        }
        $prefixes = ['ABC', 'BCD', 'DEF'];
        $randomPrefix = $this->faker->randomElement($prefixes);
        return [
            'code' => $randomPrefix . $this->faker->unique()->randomNumber(4),
            'name_id' => fake()->numberBetween(1, 100),
            'promissory_code' => fake()->name(),
            'entry_code' => $randomPrefix . $this->faker->randomNumber(4),
            'supplier_id' => fake()->numberBetween(1, 100),
            'equipment_type_id' => fake()->numberBetween(1, 30),
            'serial' => $randomNumber,
            'price' => fake()->numberBetween(10000 * 1000, 100000 * 1000),
            'use_status' => fake()->numberBetween(0, 2),
            'purchase_date' => fake()->dateTimeBetween('2020-01-01', 'now')->format('Y-m-d'),
            'warranty_period' => fake()->dateTimeBetween('2024-01-01', 'now')->format('Y-m-d'),
            'user_id' => fake()->numberBetween(1, 100),
            'description' => fake()->paragraph(3),
            'note' => fake()->paragraph(3),
            'status' => fake()->numberBetween(0, 1),
            'created_by' => fake()->numberBetween(1, 100),
        ];
    }
}
