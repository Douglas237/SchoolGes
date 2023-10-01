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
        Schema::table('admincirconscriptions', function (Blueprint $table) {
            $table->string('prenom')->after('name');
            $table->date('date_naissance')->after('prenom');
            $table->string('lieu_naissance')->after('date_naissance');
            $table->string('region_naissance')->after('lieu_naissance');
            $table->string('cni')->after('region_naissance');
            $table->string('ville_residence')->after('cni');
            $table->string('pays')->after('ville_residence');
            $table->string('adresse')->after('pays');
            $table->string('telephone')->after('adresse');
            $table->string('image')->after('telephone');
            $table->char('sexe')->after('image');
            $table->text('description')->after('sexe');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admincirconscriptions', function (Blueprint $table) {
            //
        });
    }
};
