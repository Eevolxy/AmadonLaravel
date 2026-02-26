<?php

namespace Database\Factories;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titre' => fake()->name(),
            'description' => fake()->text(),
            'note' => fake()->numberBetween(1, 5),
            'prix' => fake()->numberBetween(1, 1000),
            'categorie' => fake()->word(),
            'image' => fake()->imageUrl(),
            'user_id' => User::all()->random()->id,
        ];
    }
}
