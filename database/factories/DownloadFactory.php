<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Download>
 */
class DownloadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'name' => $this->faker->sentence(mt_rand(5, 10)),
           'url_download' => $this->faker->url(),
           'post_id' => $this->faker->numberBetween(1, 10),
           'user_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
