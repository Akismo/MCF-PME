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

        Schema::create('contenus', function (Blueprint $table) {
            $table->id();
            $table->string('titre', 200);
            $table->enum('type', ["'Article'","'Actualit\u00e9'","'\u00c9v\u00e9nement'"]);
            $table->text('contenu');
            $table->timestamp('date_publication')->nullable()->default('CURRENT_TIMESTAMP');
            $table->foreignId('auteur_id')->constrained('administrateurs')->onDelete('set null')->cascadeOnUpdate();
            $table->foreignId('administrateur_id');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contenus');
    }
};
