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
        Schema::create('salle_bases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code_salle');
            $table->string('intitule_salle');
            $table->integer('capacite_salle');
            $table->boolean('tronc_commun');
            $table->integer('nombre_tronc');
            $table->text('description');
            $table->foreignId('etablissement_id')->constrained('etablissements')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreignId('classe_id')->constrained('classes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salle_bases');
    }
};
