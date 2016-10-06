<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
  protected $fillable = [
   'patient_id',
   'treatment_number',
   'injury_date',
   'general_question',
   'main_complaint',
   'symptoms',
   'physical_examinations',
   'blood_pressure_systolic',
   'blood_pressure_diastolic',
   'heart_rate',
   'heart_rate_status',
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
   'treatment_adjustments',
   'date'
   ];
}
