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
        $categories = ['électronique', 'vêtements', 'maison', 'sport', 'livres', 'beauté', 'jouets', 'alimentation'];

        return [
            'titre' => fake()->words(rand(2, 5), true),
            'description' => fake()->paragraphs(rand(1, 3), true),
            'note' => fake()->numberBetween(1, 5),
            'prix' => fake()->randomFloat(2, 5, 500),
            'categorie' => fake()->randomElement($categories),
            'image' => 'https://picsum.photos/seed/' . fake()->unique()->randomNumber(5) . '/400/400',
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
        ];
    }
}
