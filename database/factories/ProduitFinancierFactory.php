<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\ProduitFinancier;

class ProduitFinancierFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProduitFinancier::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'nom' => fake()->regexify('[A-Za-z0-9]{100}'),
            'description' => fake()->text(),
            'conditions' => fake()->text(),
            'avantages' => fake()->text(),
            'date_creation' => fake()->dateTime(),
        ];
    }
}
