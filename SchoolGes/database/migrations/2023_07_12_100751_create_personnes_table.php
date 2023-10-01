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
        Schema::create('personnes', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string('NOM');
            $table->string('PRENOM');
            $table->date('DATE_NAISSANCE');
            $table->string('REGION_ORIGINE');
            $table->string('LIEU_NAISSANCE');
            $table->string('ADRESSE');
            $table->string('CNI');
            $table->string('VILLE_RESIDENCE');
            $table->string('PAYS');
            $table->string('TELEPHONE');
            $table->string('EMAIL');
            $table->string('IMAGE');
            $table->string('SEXE');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personnes');
    }
};
