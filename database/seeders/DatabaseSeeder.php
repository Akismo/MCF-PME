<?php

namespace Database\Seeders;

use App\Models\Administrateur;
use App\Models\Membre;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

            Administrateur::create([
                'name' => 'Administrateur Principal',
                'email' => 'admin@admin.com',
                'password' =>'Azerty2025',
                'role'  => 'president',
            ]);

            Membre::create([
                'name' => 'Membre',
                'prenom' => 'Principal',
                'email' => 'membre@membre.com',
                'password' =>'Azerty2025',
            ]);

            Administrateur::create([
                'name' => 'Comité des Affaires Financières',
                'email' => 'caf@caf.com',
                'role'  => 'caf',
                'password' =>'Azerty2025',
            ]);
            Administrateur::create([
                'name' => 'Comité de Crédit',
                'email' => 'comitecredit@comitecredit.com',
                'role'  => 'comite_credit',
                'password' =>'Azerty2025',
            ]);
    }
}
