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

        Schema::create('produit_financiers', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 100);
            $table->text('description')->nullable();
            $table->text('conditions')->nullable();
            $table->text('avantages')->nullable();
            $table->timestamp('date_creation')->nullable()->default('CURRENT_TIMESTAMP');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produit_financiers');
    }
};
