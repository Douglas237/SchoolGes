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
        Schema::create('classes_etablissements', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->BigInterger('bus_id');
            $table->BigInteger('classe_id');
            $table->BigInteger('ets_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes_etablissements');
    }
};
