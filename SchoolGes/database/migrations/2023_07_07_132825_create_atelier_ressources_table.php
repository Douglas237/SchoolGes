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
        Schema::create('atelier_ressources', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('atelier_id')->constrained('ateliers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('ressource_id')->constrained('ressources')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atelier_ressources');
    }
};
