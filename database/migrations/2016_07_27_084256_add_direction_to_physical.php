<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDirectionToPhysical extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('physical_examinations', function($table)
      {
        $table->dropColumn('direction');
      });
      Schema::table('physical_examinations', function($table)
      {
        $table->string('direction1')->nullable()->after('side');
        $table->string('direction2')->nullable()->after('direction1');
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
