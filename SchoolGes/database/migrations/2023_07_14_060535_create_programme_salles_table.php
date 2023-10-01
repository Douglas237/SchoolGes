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
        Schema::create('programme_salles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('jours', ["Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi","Dimanche"]);
            $table->text('description');
            $table->foreignId('periode_id')->constrained('periodes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('sallebase_id')->constrained('salle_bases')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programme_salles');
    }
};
