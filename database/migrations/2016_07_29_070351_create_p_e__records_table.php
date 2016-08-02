<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePERecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_e__records', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('medical_record_id');
            $table->integer('physical_examination_id');
            $table->double('direction1_value');
            $table->double('direction2_value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('p_e__records');
    }
}
