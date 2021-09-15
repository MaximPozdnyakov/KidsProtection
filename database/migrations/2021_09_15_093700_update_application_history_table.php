<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateApplicationHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('application_history', function (Blueprint $table) {
            $table->string('app')->nullable();
            $table->string('day')->nullable();
            $table->integer('time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('application_history', function (Blueprint $table) {
            $table->dropColumn('app');
            $table->dropColumn('day');
            $table->dropColumn('time');
        });
    }
}
