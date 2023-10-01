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
        Schema::create('etablissement_niveauenseigs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('numero_autorisation');
            $table->string('adress_email');
            $table->string('numero_telephone');
            $table->foreignId('etablissement_id')->constrained('etablissements')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('niveauenseignement_id')->constrained('niveau_enseignements')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etablissement_niveauenseigs');
    }
};
