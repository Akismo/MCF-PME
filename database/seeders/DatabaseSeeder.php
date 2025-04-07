<?php

namespace Database\Seeders;

use App\Models\Administrateur;
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
            ]);
    }
}
