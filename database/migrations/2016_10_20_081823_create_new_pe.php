<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewPe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::drop('physical_examinations');
      Schema::create('pe_majors', function($table)
      {
        $table->increments('id');
        $table->string('part');
      });
      Schema::create('pe_minors', function($table)
      {
        $table->increments('id');
        $table->integer('major_id');
        $table->string('description');
        $table->string('img_url');
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
