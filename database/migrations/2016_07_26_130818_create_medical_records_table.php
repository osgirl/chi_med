<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicalRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_records', function (Blueprint $table) {
            $table->increments('id');
            $table->string('patient_id')->nullable();
            $table->date('injury_date')->nullable();
            $table->string('treatment_number')->nullable();
            $table->string('main_complaint')->nullable();
            $table->string('symptoms')->nullable();
            $table->string('physical_examinations')->nullable();
            $table->string('tongue_status')->nullable();
            $table->string('body_colour')->nullable();
            $table->string('shape')->nullable();
            $table->string('movement')->nullable();
            $table->string('proper_of_coating')->nullable();
            $table->string('coating_colour')->nullable();
            $table->string('pulses')->nullable();
            $table->string('lung_qi')->nullable();
            $table->string('heart_blood')->nullable();
            $table->string('spleen')->nullable();
            $table->string('liver')->nullable();
            $table->string('kidney_yang')->nullable();
            $table->string('kidney_yin')->nullable();
            $table->string('TCM_disease')->nullable();
            $table->string('TCM_type')->nullable();
            $table->string('Acu_points')->nullable();
            $table->string('treatment_adjustments')->nullable();
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
        Schema::drop('medical_records');
    }
}
