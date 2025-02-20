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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->string('reference');
            $table->string('periode');
            $table->date('date_reser');
            $table->string('statut')->default('reserver');
            $table->text('commentaire');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("reservationscls
        ", function(Blueprint $table){
            $table->dropForeign(['id_user']);
        });
        Schema::dropIfExists('reservations');
    }
};
