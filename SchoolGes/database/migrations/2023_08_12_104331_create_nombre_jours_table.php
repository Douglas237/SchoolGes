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
        Schema::create('nombre_jours', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('jours',['Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche']);
            $table->string('description');
            $table->foreignId('etablissement_id')->constrained('etablissements')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nombre_jours');
    }
};
