<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(mt_rand(5, 10)),
            'user_id' => $this->faker->numberBetween(1, 10),
            'slug' => $this->faker->slug(),
            'category_id' => $this->faker->numberBetween(1, 10),
            'status' => $this->faker->randomElement(['draf', 'posted']),
            'overview' => $this->faker->sentence(mt_rand(20, 25)),
            'code' => $this->faker->regexify('[A-Z]{5}[0-4]{3}'),
            'poster_path' => $this->faker->imageUrl(360, 200, 'animals', true, 'dogs', true, 'jpg')
        ];
    }
}
