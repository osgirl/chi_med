<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyMedicalRecordGeneralQues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('medical_records', function($table)
      {
        $table->dropColumn('treatment_number');
      });
      Schema::table('medical_records', function($table)
      {
        $table->string('general_question')->nullable()->after('symptoms');
      });
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
