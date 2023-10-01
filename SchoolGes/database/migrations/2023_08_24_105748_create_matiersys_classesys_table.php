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
        Schema::create('matiersys_classesys', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('matieresyst_id')->constrained('matiere_systems')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('classesyst_id')->constrained('classe_systems')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matiersys_classesys');
    }
};
