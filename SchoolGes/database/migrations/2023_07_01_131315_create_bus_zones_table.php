<?php

use App\Models\Bus;
use App\Models\Zone;
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
        Schema::create('bus_zones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignIdFor(Bus::class);
            $table->foreignIdFor(Zone::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bus_zones');
    }
};
