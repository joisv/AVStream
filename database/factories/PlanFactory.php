<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plan>
 */
class PlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'price' => $this->faker->randomFloat(2, 10, 100), // Angka acak antara 10 dan 100 dengan 2 desimal
            'duration' => $this->faker->numberBetween(1, 30), // Durasi antara 30 hingga 365 hari
            'billing_cycle' => $this->faker->randomElement(['month', 'year', 'custom']),
            'description' => $this->faker->sentence(25),
        ];
    }
}
