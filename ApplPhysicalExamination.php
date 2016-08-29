<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhysicalExamination extends Model
{
  protected $fillable = array('position','side','direction1','direction1_max','direction2','direction2_max');

}
