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
        Schema::create('demande_credits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('membre_id')->unsigned();
            $table->decimal('montant', 8, places: 2);
            $table->timestamp('date_demande')->nullable()->useCurrent();
            $table->enum('statut', ['En attente', 'Approuvée', 'Refusée'])->default('En attente');
            $table->timestamps();

            $table->foreign('membre_id')->references('id')->on('membres');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demande_credits');
    }
};
