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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('role_id')->nullable(); // Ajoutez nullable() ici
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('set null'); // Ajoutez onDelete('set null')
            $table->string('name');
            $table->string('surname');
            $table->string('username')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('photo')->nullable();
            $table->text('address')->nullable();
            $table->enum('status',['active','inactive',])->default('active');
            $table->char('sexe');
            $table->string('phone');
            $table->string('phone2')->nullable();
            $table->string('pieceIdentite');
            $table->string('numeroPieceIdentite');
            $table->rememberToken();
            $table->timestamps();


            // $table->foreignId('role_id')->constrained();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
