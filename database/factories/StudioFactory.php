<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Studio>
 */
class StudioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement([
                'Prestige',
                'Modys',
                'SOD',
                'Madonna',
                'S1',
                "IdeaPocket",
                'GLory Quest',
                'Natural High',
                'ビッグモーカル',
                'ゴーゴーズ ',
                'Takara Virtual'
            ]),
            'slug' => $this->faker->slug(1, true) 
        ];
    }
}
