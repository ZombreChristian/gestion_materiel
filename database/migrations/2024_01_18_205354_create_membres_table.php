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
        Schema::create('membres', function (Blueprint $table) {
            $table->id();
            $table->string("nom");
            $table->string("prenom");
            $table->char("sexe");
            $table->date("dateNaissance");
            $table->string("lieuNaissance");
            $table->string("nationalite");
            $table->string("ville");
            $table->string("pays");
            $table->string("adresse");
            $table->string("telephone1");
            $table->string("email")->nullable();
            $table->string("telephone2")->nullable();
            $table->string("pieceIdentite");
            $table->string("noPieceIdentite");
            $table->decimal("montant")->default(0);

            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membres');
    }
};
