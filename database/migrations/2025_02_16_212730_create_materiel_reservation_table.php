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
        Schema::create('materiel_reservation', function (Blueprint $table) {
            $table->foreignId("materiel_id")->constrained();
            $table->foreignId("reservation_id")->constrained();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
        Schema::table('materiel_reservation', function(Blueprint $table){
            $table->dropForeign(["materiel_id", "reservation_id"]);
        });
        Schema::dropIfExists('materiel_reservation');
    }
};
