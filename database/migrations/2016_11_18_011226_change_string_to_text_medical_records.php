<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeStringToTextMedicalRecords extends Migration
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
        $table->integer('int_patient_id')->nullable()->after('patient_id');
        $table->text('txt_main_complaint')->nullable()->after('main_complaint');
        $table->text('txt_symptoms')->nullable()->after('symptoms');
        $table->text('txt_general_question')->nullable()->after('general_question');
        $table->text('txt_physical_examinations')->nullable()->after('physical_examinations');
        $table->text('txt_tongue_status')->nullable()->after('tongue_status');
        $table->text('txt_body_colour')->nullable()->after('body_colour');
        $table->text('txt_shape')->nullable()->after('shape');
        $table->text('txt_movement')->nullable()->after('movement');
        $table->text('txt_proper_of_coating')->nullable()->after('proper_of_coating');
        $table->text('txt_coating_colour')->nullable()->after('coating_colour');
        $table->text('txt_pulses')->nullable()->after('pulses');
        $table->text('txt_lung_qi')->nullable()->after('lung_qi');
        $table->text('txt_heart_blood')->nullable()->after('heart_blood');
        $table->text('txt_spleen')->nullable()->after('spleen');
        $table->text('txt_liver')->nullable()->after('liver');
        $table->text('txt_kidney_yang')->nullable()->after('kidney_yang');
        $table->text('txt_kidney_yin')->nullable()->after('kidney_yin');
        $table->text('txt_TCM_disease')->nullable()->after('TCM_disease');
        $table->text('txt_TCM_type')->nullable()->after('TCM_type');
        $table->text('txt_treatment_principle')->nullable()->after('treatment_principle');
        $table->text('txt_Acu_points')->nullable()->after('Acu_points');
        $table->text('txt_treatment_explanation')->nullable()->after('treatment_explanation');
        $table->text('txt_cautions')->nullable()->after('cautions');
        $table->text('txt_treatment_adjustments')->nullable()->after('treatment_adjustments');
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
