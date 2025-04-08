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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membres');
    }
};
