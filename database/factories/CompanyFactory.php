<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
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
            'description' => fake()->text($maxNbChars = 300),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'website' => 'https://www.xyz.com',
            'logo' => fake()->imageUrl(),
            'address' => fake()->sentence(),
            'city' => fake()->word(),
            'state' => fake()->word(),
        ];
    }
}
