<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeProfilFieldToProfilCencerneIdFieldInSouscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('souscriptions', function (Blueprint $table) {
            $table->removeColumn('profil_id');
            $table->foreignId('profil_concerne_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('souscriptions', function (Blueprint $table) {
            //
        });
    }
}
