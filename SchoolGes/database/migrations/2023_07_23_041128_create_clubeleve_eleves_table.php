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
        Schema::create('clubeleve_eleves', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('clubeleve_id')->constrained('club_eleves')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('eleve_id')->constrained('eleves')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clubeleve_eleves');
    }
};
