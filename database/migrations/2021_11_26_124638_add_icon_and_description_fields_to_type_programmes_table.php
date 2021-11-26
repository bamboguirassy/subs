<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIconAndDescriptionFieldsToTypeProgrammesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('type_programmes', function (Blueprint $table) {
            $table->string('icon')->nullable();
            $table->text('description')->nullable();
            $table->boolean('enabled')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('type_programmes', function (Blueprint $table) {
            //
        });
    }
}
