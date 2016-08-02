<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = array('patient_code','name','phone','cell_phone','address','DOB','gender','blood_type','acc','acc_number');

}
