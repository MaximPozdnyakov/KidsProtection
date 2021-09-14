<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAppsFieldsToChildrenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('children', function (Blueprint $table) {
            $table->boolean('allAppsLock')->default(false);
            $table->integer('allAppsLimit')->nullable()->default(null);
            $table->string('allAppsStartTime')->nullable()->default(null);
            $table->string('allAppsFinishTime')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('children', function (Blueprint $table) {
            $table->dropColumn('allAppsLock');
            $table->dropColumn('allAppsLimit');
            $table->dropColumn('allAppsStartTime');
            $table->dropColumn('allAppsFinishTime');
        });
    }
}
