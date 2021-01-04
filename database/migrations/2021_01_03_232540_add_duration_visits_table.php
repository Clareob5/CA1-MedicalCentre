<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDurationVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('visits', function (Blueprint $table) {
          $table->dropColumn('time');
          $table->time('start_time');
          $table->time('end_time');
          $table->time('duration');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('visits', function (Blueprint $table) {
          $table->dropColumn('start_time');
          $table->dropColumn('end_time');
          $table->dropColumn('duration');
          $table->time('time');
        });
    }
}
