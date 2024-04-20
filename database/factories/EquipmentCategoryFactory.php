<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EquipmentCategory>
 */
class EquipmentCategoryFactory extends Factory
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
        $prefixes = ['HJD', 'RER', 'KLI'];
        $randomPrefix = $this->faker->randomElement($prefixes);
        return [
            'code' => $randomPrefix . $this->faker->unique()->randomNumber(4),
            'name' => fake()->name(),
            'description' => fake()->name(),
            'created_by' => fake()->numberBetween(1, 100),
            'equipment_type_id' => fake()->numberBetween(1, 10),
        ];
    }
}
