<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;

class AccController extends Controller
{
    public function finish($acc_id){
      $patient = DB::table('acc_infos')->select('patient_id')->where('id','=',$acc_id)->first();
      DB::table('acc_infos')
            ->where('id', $acc_id)
            ->update(['finish' => 1]);

      return redirect('/patient/'.$patient->patient_id);
    }
}
