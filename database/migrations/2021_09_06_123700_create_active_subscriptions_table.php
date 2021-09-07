<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActiveSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('active_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('price');
            $table->integer('free_month');
            $table->string('start_dt');
            $table->string('end_dt');
            $table->string('user');
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
        Schema::dropIfExists('active_subscriptions');
    }
}
