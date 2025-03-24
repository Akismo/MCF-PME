<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('demande_credits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('membre_id')->constrained()->cascadeOnDelete();
            $table->decimal('montant', 10, 2);
            $table->timestamp('date_demande')->nullable()->default('CURRENT_TIMESTAMP');
            $table->enum('statut', ["'En attente'","'Approuv\u00e9e'","'Refus\u00e9e'"])->default('En attente');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demande_credits');
    }
};
