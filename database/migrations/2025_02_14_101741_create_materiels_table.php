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
            $table->string("nom");
            $table->string("imageUrl")->nullable();
            $table->boolean("estMutualisable")->default(0);
            $table->foreignId('type_materiel_id')->constrained('type_materiels')->onDelete('cascade');
            $table->foreignId('proprietaire_materiel_id')->constrained('proprietaire_materiels')->onDelete('cascade');
            $table->text('description')->nullable();
            $table->date('date_acquisition');
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
