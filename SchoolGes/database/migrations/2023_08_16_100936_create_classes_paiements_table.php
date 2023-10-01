<?php

use App\Models\Classe;
use App\Models\Paiement;
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
        Schema::create('classes_paiements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignIdFor(Paiement::class);
            $table->foreignIdFor(Classe::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes_paiements');
    }
};
