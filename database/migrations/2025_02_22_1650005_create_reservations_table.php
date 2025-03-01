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
            $table->foreignId('materiel_id')->constrained('materiels')->onDelete('cascade');
            $table->foreignId('statut_reservation_id')->constrained('statut_reservations')->onDelete('cascade');
            $table->foreignId('duree_reservation_id')->constrained('duree_reservations')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Clé étrangère vers la table users
            $table->dateTime('date_reservation');
            $table->text('commentaire')->nullable();
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
