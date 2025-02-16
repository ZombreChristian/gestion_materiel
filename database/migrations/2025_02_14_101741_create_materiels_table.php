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
        Schema::create('materiels', function (Blueprint $table) {
            $table->id();
            $table->string("nom")->unique();
            $table->string("imageUrl")->nullable();
            $table->boolean("estDisponible")->default(1);
            $table->foreignId("type_materiel_id")->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("materiels", function(Blueprint $table){
            $table->dropForeign("type_materiel_id");
        });
        Schema::dropIfExists('materiels');
    }
};
