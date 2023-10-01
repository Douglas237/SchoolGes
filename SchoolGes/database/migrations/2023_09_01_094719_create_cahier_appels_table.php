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
        Schema::create('cahier_appels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('periode_id')->constrained('periodes')->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->foreignId('jour_id')->constrained('nombre_jours')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('eleve_id')->constrained('eleves')->onDelete('cascade')->onUpdate('cascade');
            $table->date('date');
            $table->boolean('justification');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cahier_appels');
    }
};
