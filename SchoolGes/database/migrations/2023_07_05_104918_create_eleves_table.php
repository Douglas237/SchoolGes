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
        Schema::create('eleves', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom');
            $table->string('prenom');
            $table->string('photo');
            $table->string('genre');
            $table->string('telephone');
            $table->date('date_naissance');
            $table->string('lieu_naissance');
            $table->string('region_origine');
            $table->string('lieu_origine');
            $table->bigInteger('parent_id')->nullable();
            $table->bigInteger('salleclasse_id');
            $table->bigInteger('classe_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eleves');
    }
};
