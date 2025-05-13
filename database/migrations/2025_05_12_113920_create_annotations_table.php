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
        Schema::create('annotations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('demande_credit_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->text('contenu');
            $table->boolean('is_important')->default(false);
            $table->timestamps();

            $table->foreign('demande_credit_id')->references('id')->on('demande_credits')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annotations');
    }
};
