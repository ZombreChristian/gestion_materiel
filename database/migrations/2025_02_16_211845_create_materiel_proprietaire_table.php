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
        Schema::create('materiel_proprietaire', function (Blueprint $table) {
            $table->foreignId("materiel_id")->constrained();
            $table->foreignId("proprietaire_materiel_id")->constrained();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('materiel_proprietaire', function (Blueprint $table) {
            $table->dropForeign("materiel_id");
            $table->dropForeign("proprietaire_materiel_id");
        });
        Schema::dropIfExists('materiel_proprietaire');
    }
};
