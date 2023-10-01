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
        Schema::create('fournitures', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('libelle');
            $table->string('quantiter');
            $table->string('description');
            $table->foreignId('sallebase_id')->constrained('salle_bases')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fournitures');
    }
};
