<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropUnusedApplicationHistoryFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('application_history', function (Blueprint $table) {
            $table->dropColumn('package');
        });
        Schema::table('application_history', function (Blueprint $table) {
            $table->dropColumn('name');
        });
        Schema::table('application_history', function (Blueprint $table) {
            $table->dropColumn('image');
        });
        Schema::table('application_history', function (Blueprint $table) {
            $table->dropColumn('locked');
        });
        Schema::table('application_history', function (Blueprint $table) {
            $table->dropColumn('start_dt');
        });
        Schema::table('application_history', function (Blueprint $table) {
            $table->dropColumn('end_dt');
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
            $table->string('package')->nullable();
            $table->string('name')->nullable();
            $table->binary('image')->nullable();
            $table->boolean('locked')->default(0);
            $table->string('start_dt')->nullable();
            $table->string('end_dt')->nullable();
        });
    }
}
