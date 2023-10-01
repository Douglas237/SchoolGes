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
        Schema::create('programmesemaines', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->unsignedBigInteger("salleClasse_id");
            $table->unsignedBigInteger("enseignant_id");
            $table->integer("num_programme");
            $table->string("semaine_programme");
            $table->string('jour');
            $table->date('date');
            $table->time("heure_debut");
            $table->time("heure_fin");
            $table->foreign('salleClasse_id')->references('id')->on('salle_classes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('enseignant_id')->references('id')->on('enseignants')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programmesemaines');
    }
};
