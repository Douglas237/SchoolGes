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
        Schema::create('jour_periodes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('jour_id')->constrained('nombre_jours')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('periode_id')->constrained('periodes')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jour_periodes');
    }
};
