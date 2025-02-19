<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('equipements', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->integer('utilisation')->default(0);
            $table->integer('reservations')->default(0);
            $table->integer('annulations')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('equipements');
    }
};
