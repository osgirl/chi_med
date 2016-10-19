<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropInjuryDateFromMedicalRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('medical_firsts', function($table)
      {
        $table->date('injury_date')->nullable()->after('medical_record_id');
      });
      Schema::table('medical_records', function($table)
      {
        $table->dropColumn('injury_date');
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
