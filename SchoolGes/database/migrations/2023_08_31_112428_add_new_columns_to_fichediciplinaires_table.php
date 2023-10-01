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
        Schema::table('fichediciplinaires', function (Blueprint $table) {
            $table->text('motif')->after('sanction');
            $table->date('date_debut')->after('motif');
            $table->date('date_fin')->after('date_debut');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fichediciplinaires', function (Blueprint $table) {
            //
        });
    }
};
