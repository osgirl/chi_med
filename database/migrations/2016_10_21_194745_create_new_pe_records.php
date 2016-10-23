<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewPeRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('p_e__records');
        Schema::create('pe_records', function($table)
        {
          $table->increments('id');
          $table->integer('medical_record_id')->nullable();
          $table->integer('pe_minor_id')->nullable();
          $table->string('value')->nullable();

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
