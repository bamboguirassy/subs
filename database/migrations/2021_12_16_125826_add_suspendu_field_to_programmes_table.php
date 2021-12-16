<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSuspenduFieldToProgrammesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('programmes', function (Blueprint $table) {
            $table->boolean('suspendu')->comment('pour les cotisations récurrentes qui sarrete seulement si programme suspendu')->default(false);
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
