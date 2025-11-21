<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Program>
 */
class ProgramFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'schedule' => fake()->dayOfWeek() . ', ' . fake()->time(),
            'location' => fake()->address(),
            'type' => fake()->randomElement(['rutin', 'bulanan', 'tahunan']),
            'status' => fake()->randomElement(['Coming Soon', 'Selesai']),
            'is_active' => fake()->boolean(),
        ];
    }
}