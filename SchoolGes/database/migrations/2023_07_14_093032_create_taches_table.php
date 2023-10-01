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
        Schema::create('taches', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->unsignedBigInteger("ID_PERSONNE");
            $table->string("NOM_TACHE");
            $table->date("DATE_DEBUT");
            $table->time("HEURE_DEBUT");
            $table->longText("description");
            $table->foreign('ID_PERSONNE')->references('id')->on('personnes')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taches');
    }
};
