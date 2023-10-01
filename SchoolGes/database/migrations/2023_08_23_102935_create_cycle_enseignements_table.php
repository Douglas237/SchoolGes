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
        Schema::create('cycle_enseignements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('admincirconscription_id')->constrained('admincirconscriptions')->onDelete('cascade')->onUpdate('cascade');
            $table->string('intituler');
            $table->string('categories');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cycle_enseignements');
    }
};
