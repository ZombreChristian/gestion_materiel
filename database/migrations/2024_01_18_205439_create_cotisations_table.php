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
        Schema::create('cotisations', function (Blueprint $table) {
            $table->id();
            $table->string('membre_id');
            $table->string('date');
            $table->string('Nosemaine');
            $table->integer('lundi')->nullable()->default(0);
            $table->integer('mardi')->nullable()->default(0);
            $table->integer('mercredi')->nullable()->default(0);
            $table->integer('jeudi')->nullable()->default(0);
            $table->integer('vendredi')->nullable()->default(0);
            $table->integer('samedi')->nullable()->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cotisations');
    }
};
