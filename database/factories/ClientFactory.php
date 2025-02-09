<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'type_id' => fake()->randomElement(['CE', 'CC', 'TI']),
            'document' => (string) fake()->numberBetween(100000, 999999999),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
