<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Casebook>
 */
class CasebookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'note' => fake()->jobTitle(),
            'credit_balance' => fake()->randomNumber(5, true),
            'credit_type' => fake()->numberBetween(0,1)
        ];
    }
}
