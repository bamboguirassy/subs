<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tirages', function (Blueprint $table) {
            $table->id();
            $table->uuid('numero');
            $table->foreignId('souscription_id');
            $table->bigInteger('montant');
            $table->foreignId('programme_id');
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
        Schema::dropIfExists('tirages');
    }
}
