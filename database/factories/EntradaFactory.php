<?php

namespace Database\Factories;
use App\Models\Entrada;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Models\Entrada>
 */
class EntradaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $total = User::count();
        return [
            'titulo' => fake()->name(),
            'contenido' => fake()->text(400),
            'user_id' => fake()->numberBetween(1, $total)
        ];
    }
}
