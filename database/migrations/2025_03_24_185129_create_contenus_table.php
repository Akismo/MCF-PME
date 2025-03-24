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

        Schema::create('contenus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titre', 200);
            $table->integer('auteur_id')->unsigned();
            $table->enum('type', ['Article','Actualité','Événement']);
            $table->text('contenu');
            $table->timestamp('date_publication')->nullable()->useCurrent();
            $table->foreign('auteur_id')->references('id')->on('users');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contenus');
    }
};
