<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgrammesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programmes', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('nom');
            $table->dateTime('dateCloture');
            $table->dateTime('dateDemarrage');
            $table->string('duree');
            $table->integer('nombreSeance');
            $table->integer('nombreParticipants');
            $table->string('description');
            $table->string('modeDeroulement');
            $table->string('modeDeroulement');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('programmes');
    }
}
