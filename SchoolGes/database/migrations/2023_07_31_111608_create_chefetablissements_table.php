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
        Schema::create('chefetablissements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('admincirconscription_id');
            $table->string('name');
            $table->string('prenom');
            $table->date('date_naissance');
            $table->string('lieu_naissance');
            $table->string('region_naissance');
            $table->string('cni');
            $table->string('ville_residence');
            $table->string('pays');
            $table->string('adresse');
            $table->string('telephone');
            $table->string('image');
            $table->char('sexe');
            $table->text('description');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chefetablissements');
    }
};
