<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\DemandeCredit;
use App\Models\Membre;

class DemandeCreditFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DemandeCredit::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'membre_id' => Membre::factory(),
            'montant' => fake()->randomFloat(2, 0, 99999999.99),
            'date_demande' => fake()->dateTime(),
            'statut' => fake()->randomElement(["'En attente'","'Approuv\u00e9e'","'Refus\u00e9e'"]),
        ];
    }
}
