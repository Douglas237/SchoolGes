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
        Schema::create('matieres', function (Blueprint $table) {
            $table->bigIncrements('id');
            //$table->bigInteger('classe_id');
            $table->foreignId('classe_id')->constrained('classes')->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->foreignId('etablissement_id')->constrained('etablissements')->onDelete('cascade')->onUpdate('cascade');
            $table->string('code_matiere')->nullable();
            $table->string('intituler_etablissement')->nullable();
            $table->integer('volumehoraire_etablissement')->nullable();
            $table->integer('coefficient_etablissement')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matieres');
    }
};
