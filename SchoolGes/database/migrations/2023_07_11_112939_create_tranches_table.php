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
        Schema::create('tranches', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->unsignedBigInteger("paiement_id");
            $table->integer("NUM_TRANCHE");
            $table->string("LIBELER");
            $table->double('MONTANT',8.2);
            $table->date('DATE_FIN');
            $table->longText("description");
            $table->foreign('paiement_id')->references('id')->on('paiements')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tranches');
    }
};
