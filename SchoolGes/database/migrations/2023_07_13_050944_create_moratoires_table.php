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
        Schema::create('moratoires', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('numero_moratoire');
            $table->string('motif');
            $table->text('description');
            $table->date('date_prorogation');
            $table->foreignId('tranche_id')->constrained('tranches')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moratoires');
    }
};
