<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('patient_code')->nullable();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('cell_phone')->nullable();
            $table->string('address')->nullable();
            $table->date('DOB')->nullable();
            $table->string('gender')->nullable();
            $table->string('blood_type')->nullable();
            $table->string('acc')->nullable();
            $table->string('acc_number')->nullable();
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
        Schema::drop('patients');
    }
}
