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
        Schema::create('complex_sportifs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom_complex_sportifs');
            $table->text('description');
            $table->date('date_creation');
            // $table->foreignId('etablissement_id')->constrained('etablissements');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complex_sportifs');
    }
};
