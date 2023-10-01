<?php

use App\Models\CahierTexte;
use App\Models\Programmesemaine;
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
        Schema::create('programmesemaines_cahiertextes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignIdFor(Programmesemaine::class);
            $table->foreignIdFor(CahierTexte::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programmesemaines_cahiertextes');
    }
};
