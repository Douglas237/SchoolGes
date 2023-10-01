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
        Schema::create('classe_livresprogramme', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->BigInterger('bus_id');
            $table->BigInteger('classe_id');
            $table->BigInteger('livresprogramme_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classe_livresprogramme');
    }
};
