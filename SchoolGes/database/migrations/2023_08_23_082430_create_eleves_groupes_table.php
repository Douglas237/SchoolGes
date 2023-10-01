<?php

use App\Models\Eleve;
use App\Models\Groupe;
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
        Schema::create('eleves_groupes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignIdFor(Eleve::class);
            $table->foreignIdFor(Groupe::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eleves_groupes');
    }
};
