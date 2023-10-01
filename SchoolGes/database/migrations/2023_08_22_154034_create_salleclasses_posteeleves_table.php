<?php

use App\Models\Poste;
use App\Models\SalleClasse;
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
        Schema::create('salleclasses_posteeleves', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignIdFor(SalleClasse::class);
            $table->foreignIdFor(Poste::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salleclasses_posteeleves');
    }
};
