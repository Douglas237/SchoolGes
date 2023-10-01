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
        Schema::create('billet_entrer_sortis', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->unsignedBigInteger("eleve_id");
            $table->string("CLASSE");
            $table->string("SALLE");
            $table->longText("MOTIF");
            $table->longText("description");
            $table->foreign('eleve_id')->references('id')->on('eleves')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billet_entrer_sortis');
    }
};
