<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Administrateur;
use App\Models\Contenu;

class ContenuFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contenu::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'titre' => fake()->regexify('[A-Za-z0-9]{200}'),
            'type' => fake()->randomElement(["'Article'","'Actualit\u00e9'","'\u00c9v\u00e9nement'"]),
            'contenu' => fake()->text(),
            'date_publication' => fake()->dateTime(),
            'auteur_id' => Administrateur::factory(),
            'administrateur_id' => Administrateur::factory(),
        ];
    }
}
