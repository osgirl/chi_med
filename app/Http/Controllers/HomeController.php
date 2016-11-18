<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:user');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('id','=',Auth::id())->first();
        return view('home')->with('user',$user);
    }

    public function test(){

        $records = DB::table('medical_records')->get();
        foreach ($records as $rec) {
          DB::table('medical_records')
              ->where('id', $rec->id)
              ->update([
                'int_patient_id' => $rec->patient_id,
                'txt_main_complaint' => $rec->main_complaint,
                'txt_symptoms' => $rec->symptoms,
                'txt_general_question' => $rec->general_question,
                'txt_physical_examinations' => $rec->physical_examinations,
                'txt_tongue_status' => $rec->tongue_status,
                'txt_body_colour' => $rec->body_colour,
                'txt_shape' => $rec->shape,
                'txt_movement' => $rec->movement,
                'txt_proper_of_coating' => $rec->proper_of_coating,
                'txt_coating_colour' => $rec->coating_colour,
                'txt_pulses' => $rec->pulses,
                'txt_lung_qi' => $rec->lung_qi,
                'txt_heart_blood' => $rec->heart_blood,
                'txt_spleen' => $rec->spleen,
                'txt_liver' => $rec->liver,
                'txt_kidney_yang' => $rec->kidney_yang,
                'txt_kidney_yin' => $rec->kidney_yin,
                'txt_TCM_disease' => $rec->TCM_disease,
                'txt_TCM_type' => $rec->TCM_type,
                'txt_treatment_principle' => $rec->treatment_principle,
                'txt_Acu_points' => $rec->Acu_points,
                'txt_treatment_explanation' => $rec->treatment_explanation,
                'txt_cautions' => $rec->cautions,
                'txt_treatment_adjustments' => $rec->treatment_adjustments
              ]);
        }
    }
}
