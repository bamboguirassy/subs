<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFieldStatutToAppelFondsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appel_fonds', function (Blueprint $table) {
            $table->string('etat')->default("En attente");
            $table->dropColumn('traite');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appel_fonds', function (Blueprint $table) {
            //
        });
    }
}
