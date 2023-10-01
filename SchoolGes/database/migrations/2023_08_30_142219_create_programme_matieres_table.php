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
        Schema::create('programme_matieres', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('admincirconscription_id')->constrained('admincirconscriptions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('matieresyst_id')->constrained('matiere_systems')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('num_lecon');
            $table->string('intituler_lecon');
            $table->integer('volume_horaire');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programme_matieres');
    }
};
