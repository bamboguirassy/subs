<?php

use App\Models\PackSms;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAchatSmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('achat_sms', function (Blueprint $table) {
            $table->id();
            $table->integer('nombreSms');
            $table->string('uid');
            $table->boolean('confirmed')->default(false);
            $table->bigInteger('montant');
            $table->foreignIdFor(PackSms::class,'pack_sms_id')->constrained();
            $table->foreignId('user_id')->constrained();
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
        Schema::dropIfExists('achat_sms');
    }
}
