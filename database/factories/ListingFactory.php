<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->sentence(),
            'description' => fake()->text($maxNbChars = 300),	
            'work_type' => fake()->word(),
            'tag' => 'Maths, Remote, IGSCE',
            'city' => fake()->word(),	
            'state' => fake()->word(),
            'responsibility' => fake()->text($maxNbChars = 300),	
            'qualification' => fake()->text($maxNbChars = 300),
        ];
    }
}
