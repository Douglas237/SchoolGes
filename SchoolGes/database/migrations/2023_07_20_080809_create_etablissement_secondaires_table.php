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
        Schema::create('etablissement_secondaires', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->unsignedBigInteger("ID_ETABLISSEMENT");
            $table->unsignedBigInteger("ID_COMPLEX_SPORTIF");
            $table->longText("description");
            $table->foreign('ID_ETABLISSEMENT')->references('id')->on('etablissements')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ID_COMPLEX_SPORTIF')->references('id')->on('complex_sportifs')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etablissement_secondaires');
    }
};
