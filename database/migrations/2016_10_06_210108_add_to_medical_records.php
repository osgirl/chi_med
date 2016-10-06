<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddToMedicalRecords extends Migration
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
        $table->string('treatment_principle')->nullable()->after('TCM_type');
        $table->string('treatment_explanation',750)->nullable()->after('Acu_points');
        $table->string('cautions')->nullable()->after('treatment_explanation');
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
