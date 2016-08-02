<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PE_Record extends Model
{
  protected $fillable = array('medical_record_id','physical_examination_id','direction1_value','direction2_value');

}
