<?php

use App\Models\CahierTexte;
use App\Models\programme_matiere;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cahiertextes_programmematieres', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignIdFor(programme_matiere::class);
            $table->foreignIdFor(CahierTexte::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cahiertextes_programmematieres');
    }
};
