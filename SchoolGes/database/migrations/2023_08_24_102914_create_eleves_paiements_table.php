<?php

use App\Models\Eleve;
use App\Models\Paiement;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('eleves_paiements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('montant_payer');
            $table->date('date');
            $table->boolean('statut_insolvabilite')->default(0)->nullable();
            $table->boolean('statut_classe')->default(0)->nullable();
            $table->boolean('statut_etablissement')->default(0)->nullable();
            $table->integer('tranche');
            $table->foreignIdFor(Eleve::class);
            $table->foreignIdFor(Paiement::class)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eleves_paiements');
    }
};
