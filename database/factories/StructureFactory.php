<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Structure>
 */
class StructureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'position' => fake()->jobTitle(),
            'group_type' => fake()->randomElement(['teras', 'division']),
            'division_name' => fake()->word(),
            'level' => fake()->numberBetween(1, 5),
            'sort_order' => fake()->numberBetween(1, 10),
            'is_active' => fake()->boolean(),
        ];
    }
}