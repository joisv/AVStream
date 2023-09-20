<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Actress>
 */
class ActressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'age' => $this->faker->numberBetween(10, 60),
            'cup_size' => $this->faker->randomElement([
                'A',
                'B',
                'C',
                'D',
                'E',
                'F',
                'G',
                'H',
                'I',
                'J',
            ]),
            'height' => $this->faker->numberBetween(131, 190),
            'name' => $this->faker->name('female'),
            'slug' => $this->faker->slug(),
            'debut' => $this->faker->numberBetween(2000, 2023),
            'profile' => $this->faker->imageUrl(100, 100, 'animals', true, 'dogs', true, 'jpg')
        ];
    }
}
