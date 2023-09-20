<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Genre>
 */
class GenreFactory extends Factory
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
            'Hd',
            'Exclusive',
            'Creampie',
            'Big Breast',
            'Individual',
            'Wife',
            'Mature Woman',
            'Ordinary Person',
            'Pretty Girl',
            'Ride',
            'Oral Sex',
            'Orgy',
            'High School Girl',
            'Squirting',
            'Fetish',
            'Selfie',
            'Tit Job',
            'Sneak Shot',
            'Bukkake'
           ]),
           'slug' => $this->faker->randomElement([
            'Hd',
            'Exclusive',
            'Creampie',
            'Big-Breast',
            'Individual',
            'Wife',
            'Mature-Woman',
            'Ordinary-Person',
            'Pretty-Girl',
            'Ride',
            'Oral-Sex',
            'Orgy',
            'High-School-Girl',
            'Squirting',
            'Fetish',
            'Selfie',
            'Tit-Job',
            'Sneak-Shot',
            'Bukkake'
           ]),
        ];
    }
}
