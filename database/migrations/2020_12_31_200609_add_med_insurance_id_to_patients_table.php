<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMedInsuranceIdToPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->dropColumn('insurance_company');
            $table->unsignedBigInteger('med_insurance_id');

            $table->foreign('med_insurance_id')->references('id')->on('med_insurances')->onUpdate('cascade')->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patients', function (Blueprint $table) {
              $table->dropForeign(['med_insurance_id']);
              $table->dropColumn('med_insurance_id');
              $table->string('insurance_company');
        });
    }
}
