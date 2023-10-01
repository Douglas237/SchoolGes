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
        Schema::create('paiements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('montant_totale');
            $table->boolean('Avance')->default(0)->nullable();
            $table->boolean('tranches')->default(0)->nullable();
            $table->boolean('moratoire')->default(0)->nullable();
            $table->bigInteger('type_paiement_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
