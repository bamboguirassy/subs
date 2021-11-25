<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatesToProgrammesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('programmes', function (Blueprint $table) {
            $table->date('dateDemarrage')->nullable()->change();
            $table->string('modeDeroulement')->nullable()->change();
            $table->bigInteger('montant')->nullable()->comment("Le montant qui doit être payé - pour les programmes qui ne ciblent pas de profil");
            $table->boolean('paiementMultiple')->comment("Autoriser le paiement multiple...")->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('programmes', function (Blueprint $table) {
            //
        });
    }
}
