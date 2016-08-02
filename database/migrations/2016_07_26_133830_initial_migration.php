<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InitialMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      /*Schema::table('medical_records', function($table)
      {
        $table->dropColumn('blood_pressure_systolic');
        $table->dropColumn('blood_pressure_diastolic');
        $table->dropColumn('heart_rate');
        $table->dropColumn('heart_rate_status');
      });*/
      /*Schema::table('medical_records', function($table)
      {
        $table->string('general_question')->nullable()->after('symptoms');
        $table->string('PE_back_E')->nullable();
        $table->string('PE_back_F')->nullable();
        $table->string('PE_lateral_L')->nullable();
        $table->string('PE_lateral_R')->nullable();
        $table->string('PE_neck_E')->nullable();
        $table->string('PE_neck_F')->nullable();
        $table->string('PE_neck_lateral_L')->nullable();
        $table->string('PE_neck_lateral_R')->nullable();
        $table->string('PE_neck_rotation_L')->nullable();
        $table->string('PE_neck_rotation_R')->nullable();

      });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
