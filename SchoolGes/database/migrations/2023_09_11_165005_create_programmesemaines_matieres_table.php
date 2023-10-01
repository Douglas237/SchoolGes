<?php

use App\Models\Matiere;
use App\Models\Programmesemaine;
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
        Schema::create('programmesemaines_matieres', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignIdFor(Programmesemaine::class);
            $table->foreignIdFor(Matiere::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programmesemaines_matieres');
    }
};
