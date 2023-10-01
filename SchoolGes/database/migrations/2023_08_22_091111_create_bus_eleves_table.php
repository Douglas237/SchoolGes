<?php

use App\Models\Bus;
use App\Models\Eleve;
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
        Schema::create('bus_eleves', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignIdFor(Bus::class);
            $table->foreignIdFor(Eleve::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bus_eleves');
    }
};
