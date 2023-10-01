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
        Schema::create('controles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('num_controle');
            $table->date('date_controle');
            $table->string('semaine_controle');
            $table->text('description');
            $table->enum('jour', ["Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi","Dimanche"]);
            $table->foreignId('sequence_id')->constrained('sequences')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('controles');
    }
};
