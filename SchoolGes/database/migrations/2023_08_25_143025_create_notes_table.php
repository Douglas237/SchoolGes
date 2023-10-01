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
        Schema::create('notes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('matiere_id');
            $table->bigInteger('classe_id');
            $table->bigInteger('salleclasse_id');
            $table->bigInteger('eleve_id');
            $table->bigInteger('trimestre_id');
            $table->bigInteger('sequence_id');
            $table->bigInteger('enseignant_id');
            $table->double('note');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
