<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscription>
 */
class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 10),
            'plan_id' => $this->faker->numberBetween(1, 3),
            'start_date' => $this->faker->date('Y-m-d'), // Perhatikan format tanggal yang benar
            'end_date' =>  $this->faker->dateTimeBetween('-1 week', '+1 week')->format('Y-m-d H:i:s'), // Format tanggal dan waktu
            'status' => $this->faker->randomElement(['active', 'cancelled', 'pending', 'expired']), // Menggunakan randomElement
            // 'billing_cycle' => $this->faker->randomElement(['monthly', 'anual', 'custom']), // Menggunakan randomElement
            'billing_amount' => $this->faker->randomFloat(2, 1, 1000), // Angka desimal dengan dua digit di belakang koma
            'payment_method' => 'Direct Transfer',
        ];
    }
}
