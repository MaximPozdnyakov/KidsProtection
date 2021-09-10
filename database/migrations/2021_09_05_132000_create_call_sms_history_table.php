<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCallSmsHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_sms_history', function (Blueprint $table) {
            $table->id();
            $table->string('phone');
            $table->boolean('input');
            $table->boolean('isCall');
            $table->string('message')->nullable();
            $table->string('date');
            $table->string('child');
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
        Schema::dropIfExists('call_sms_history');
    }
}
