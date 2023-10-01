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
        Schema::create('publication_enseignants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date_publication');
            $table->text('description');
            $table->string('piece_jointe')->nullable();
            $table->foreignId('sallebase_id')->constrained('salle_bases');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publication_enseignants');
    }
};
