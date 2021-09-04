<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_statistics', function (Blueprint $table) {
            $table->id();
            $table->string('package');
            $table->string('name');
            $table->binary('image');
            $table->boolean('locked');
            $table->string('start_dt');
            $table->string('end_dt')->nullable();
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
        Schema::dropIfExists('application_statistics');
    }
}
