<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Membre;

class MembreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Membre::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'numAdherent' => fake()->regexify('[A-Za-z0-9]{50}'),
            'nom' => fake()->regexify('[A-Za-z0-9]{100}'),
            'prenom' => fake()->regexify('[A-Za-z0-9]{100}'),
            'email' => fake()->safeEmail(),
            'mot_de_passe' => fake()->regexify('[A-Za-z0-9]{255}'),
            'date_inscription' => fake()->dateTime(),
        ];
    }
}
