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
        Schema::create('livre_programmes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('TITRE_LIVRE');
            $table->text('DOMAINE');
            $table->string('GROUPEMENT');
            $table->string('EDITION');
            $table->string('hauteur');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livre_programmes');
    }
};
