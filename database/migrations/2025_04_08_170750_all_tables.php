<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Table administrateurs
        Schema::create('administrateurs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['president', 'caf', 'comite_credit']);
            $table->rememberToken();
            $table->timestamps();
        });

        // Table membres
        Schema::create('membres', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numAdherent', 50)->unique();
            $table->string('name', 100);
            $table->string('prenom', 100);
            $table->string('email', 255)->unique();
            $table->string('password', 255);
            $table->timestamp('date_inscription')->nullable()->useCurrent();
            $table->timestamps();
        });

        // Table produit_financiers
        Schema::create('produit_financiers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom', 100);
            $table->text('description')->nullable();
            $table->text('conditions')->nullable();
            $table->text('avantages')->nullable();
            $table->timestamp('date_creation')->nullable()->useCurrent();
            $table->timestamps();
        });

        // Table contenus
        Schema::create('contenus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titre', 200);
            $table->integer('administrateur_id')->unsigned();
            $table->enum('type', ['Article', 'Actualité', 'Événement']);
            $table->text('contenu');
            $table->timestamp('date_publication')->nullable()->useCurrent();
            $table->timestamps();

            $table->foreign('administrateur_id')->references('id')->on('administrateurs')->onDelete('cascade');
        });

        // Table contenu_images
        Schema::create('contenu_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contenu_id')->unsigned();
            $table->string('chemin');
            $table->string('alt_text')->nullable();
            $table->boolean('is_principal')->default(false);
            $table->timestamps();

            $table->foreign('contenu_id')->references('id')->on('contenus')->onDelete('cascade');
        });

        // Table demande_credits
        Schema::create('demande_credits', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type_credit', ['Ligne de crédit', 'Avance sur facture', 'Bon de commande', 'Fonds de roulement', 'AGR']);
            $table->integer('membre_id')->unsigned();
            $table->decimal('montant', 12, 2);
            $table->text('description_projet')->nullable();
            $table->string('duree')->nullable();
            $table->timestamp('date_demande')->nullable()->useCurrent();
            $table->enum('statut', ['En attente', 'Approuvée', 'Refusée'])->default('En attente');
            $table->text('commentaires')->nullable();
            $table->timestamps();

            $table->foreign('membre_id')->references('id')->on('membres')->onDelete('cascade');
        });

        Schema::create('document_demandes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('demande_credit_id')->unsigned();
            $table->string('type_document');
            $table->string('chemin_fichier');
            $table->string('nom_original');
            $table->timestamps();

            $table->foreign('demande_credit_id')->references('id')->on('demande_credits')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demande_credits');
        Schema::dropIfExists('contenu_images');
        Schema::dropIfExists('contenus');
        Schema::dropIfExists('produit_financiers');
        Schema::dropIfExists('membres');
        Schema::dropIfExists('administrateurs');
        Schema::dropIfExists('document_demandes');
    }
};
