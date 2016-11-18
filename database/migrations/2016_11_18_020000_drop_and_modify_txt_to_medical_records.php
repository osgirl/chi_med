<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropAndModifyTxtToMedicalRecords extends Migration
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
          $table->dropColumn(array(
            'patient_id',
            'main_complaint',
            'symptoms',
            'general_question',
            'physical_examinations',
            'tongue_status',
            'body_colour',
            'shape',
            'movement',
            'proper_of_coating',
            'coating_colour',
            'pulses',
            'lung_qi',
            'heart_blood',
            'spleen',
            'liver',
            'kidney_yang',
            'kidney_yin',
            'TCM_disease',
            'TCM_type',
            'treatment_principle',
            'Acu_points',
            'treatment_explanation',
            'cautions',
            'treatment_adjustments'
          ));
        });
        Schema::table('medical_records', function($table)
        {
            $table->renameColumn('int_patient_id','patient_id');
            $table->renameColumn('txt_main_complaint','main_complaint');
            $table->renameColumn('txt_symptoms','symptoms');
            $table->renameColumn('txt_general_question','general_question');
            $table->renameColumn('txt_physical_examinations','physical_examinations');
            $table->renameColumn('txt_tongue_status','tongue_status');
            $table->renameColumn('txt_body_colour','body_colour');
            $table->renameColumn('txt_shape','shape');
            $table->renameColumn('txt_movement','movement');
            $table->renameColumn('txt_proper_of_coating','proper_of_coating');
            $table->renameColumn('txt_coating_colour','coating_colour');
            $table->renameColumn('txt_pulses','pulses');
            $table->renameColumn('txt_lung_qi','lung_qi');
            $table->renameColumn('txt_heart_blood','heart_blood');
            $table->renameColumn('txt_spleen','spleen');
            $table->renameColumn('txt_liver','liver');
            $table->renameColumn('txt_kidney_yang','kidney_yang');
            $table->renameColumn('txt_kidney_yin','kidney_yin');
            $table->renameColumn('txt_TCM_disease','TCM_disease');
            $table->renameColumn('txt_TCM_type','TCM_type');
            $table->renameColumn('txt_treatment_principle','treatment_principle');
            $table->renameColumn('txt_Acu_points','Acu_points');
            $table->renameColumn('txt_treatment_explanation','treatment_explanation');
            $table->renameColumn('txt_cautions','cautions');
            $table->renameColumn('txt_treatment_adjustments','treatment_adjustments');
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
