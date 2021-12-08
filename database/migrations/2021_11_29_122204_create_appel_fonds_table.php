<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppelFondsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appel_fonds', function (Blueprint $table) {
            $table->id();
            $table->string('methodePaiement');
            $table->string('mobilePaiement');
            $table->string('montant')->require();
            $table->boolean('traite')->default(false);
            $table->date('dateTraitement')->nullable();
            $table->text('observation')->nullable();
            $table->foreignId('programme_id')->constrained();
            $table->foreignId('user_id')->nullable()->comment('le user ayant validé...');
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
        Schema::dropIfExists('appel_fonds');
    }
}
