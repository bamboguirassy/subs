<?php

use App\Models\Programme;
use App\Models\SouscriptionTemp;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubSouscriptionTempsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_souscription_temps', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(SouscriptionTemp::class);
            $table->foreignIdFor(Programme::class);
            $table->bigInteger('montant')->require();
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
        Schema::dropIfExists('sub_souscription_temps');
    }
}
