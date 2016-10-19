<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFirstVisitForm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('medical_firsts', function($table)
      {
        $table->increments('id');
        $table->integer('patient_id');
        $table->integer('medical_record_id');
        $table->text('family_history')->nullable();
        $table->boolean('infectious_disease')->nullable();
        $table->boolean('asthma')->nullable();
        $table->boolean('cancer')->nullable();
        $table->boolean('abnormal_blood_pressure')->nullable();
        $table->boolean('heart_condition')->nullable();
        $table->boolean('diabetes')->nullable();
        $table->boolean('mental_health_conditions')->nullable();
        $table->boolean('bleeding_disorders')->nullable();
        $table->boolean('epilepsy')->nullable();
        $table->boolean('thyroid_diseases')->nullable();
        $table->boolean('surgery')->nullable();
        $table->boolean('fractures')->nullable();
        $table->boolean('taking_prescribed_medicine')->nullable();
        $table->boolean('regularly_take_supplement')->nullable();
        $table->text('full_details')->nullable();
        $table->text('menstruation')->nullable();
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
