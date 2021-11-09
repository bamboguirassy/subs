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
            $table->foreignId('type_programme_id')->constrained();
            $table->string('nom');
            $table->dateTime('dateCloture');
            $table->dateTime('dateDemarrage');
            $table->integer('duree')->nullable();
            $table->integer('nombreSeance')->nullable();
            $table->integer('nombreParticipants')->nullable();
            $table->text('description');
            $table->string('modeDeroulement');
            $table->string('image')->nullable();
            // formateur
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
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
