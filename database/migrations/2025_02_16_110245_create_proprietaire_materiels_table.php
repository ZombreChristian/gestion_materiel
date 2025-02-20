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
        Schema::create('proprietaire_materiels', function (Blueprint $table) {
            $table->id();
            $table->string("nom");
            $table->boolean("estObligatoire")->default(1);
            $table->foreignId("type_materiels_id")->constrained();

            $table->unique(["nom", "type_materiels_id"]);
        });

        Schema::enableForeignKeyConstraints();
        // Schema::create('proprietaire_materiels', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proprietaire_materiels', function (Blueprint $table) {
            $table->dropForeign("type_materiels_id");
        });
        Schema::dropIfExists('proprietaire_materiels');
    }
};
