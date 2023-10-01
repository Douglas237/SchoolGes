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
        Schema::create('etablissements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('admincirconscription_id');
            $table->bigInteger('chefetablissement_id');
            $table->string('nom');
            $table->string('adress_postal');
            $table->string('abreviation_nom');
            $table->string('devise');
            $table->string('logo');
            $table->string('adresse_email');
            $table->string('telephone');
            $table->string('siege_sociale');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etablissements');
    }
};
