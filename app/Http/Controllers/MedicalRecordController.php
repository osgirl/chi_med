<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Patient;
use App\MedicalRecord;
use App\PE_Record;
use Datetime;
use DB;

class MedicalRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
       $this->middleware('permission:user');
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($patient, $acc)
    {
        $patient = Patient::find($patient);
        $pe_majors = DB::table('pe_majors')->get();
        $pe_minors = DB::table('pe_minors')->get();
        $treatment_number = MedicalRecord::where('patient_id','=',$patient->id)
            ->where('acc_id' , '=' , $acc)
            ->max('treatment_number') +1 ;
        if($treatment_number == 1){
          return view('medical_record/create_first')
          ->with('patient',$patient)->with('pe_majors',$pe_majors)->with('pe_minors',$pe_minors)
          ->with('treatment_number',$treatment_number)->with('acc_id',$acc);
        }else{
          return view('medical_record/create')
          ->with('patient',$patient)->with('pe_majors',$pe_majors)->with('pe_minors',$pe_minors)
          ->with('treatment_number',$treatment_number)->with('acc_id',$acc);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $cre_date = DateTime::createFromFormat('d-m-Y', $request->date);
      $date = $cre_date->format('Y-m-d');
      //find the max treatment number

      $MedicalRecords = MedicalRecord::create(
      array(
        'patient_id' => $request->patient_id,
        'acc_id' => $request->acc_id,
        'treatment_number' => $request->treatment_number,
        'date' => $date,
        'main_complaint' => $request->main_complaint,
        'symptoms' => $request->symptoms,
        'general_question' => $request->general_question,
        'physical_examinations' => $request->physical_examinations,
        'tongue_status' => $request->tongue_status,
        'body_colour' => $request->body_colour,
        'shape' => $request->shape,
        'movement' => $request->movement,
        'proper_of_coating' => $request->proper_of_coating,
        'coating_colour' => $request->coating_colour,
        'pulses' => $request->pulses,
        'lung_qi' => $request->lung_qi,
        'heart_blood' => $request->heart_blood,
        'spleen' => $request->spleen,
        'liver' => $request->liver,
        'kidney_yang' => $request->kidney_yang,
        'kidney_yin' => $request->kidney_yin,
        'TCM_disease' => $request->TCM_disease,
        'TCM_type' => $request->TCM_type,
        'treatment_principle' => $request->treatment_principle,
        'Acu_points' => $request->Acu_points,
        'treatment_explanation' => $request->treatment_explanation,
        'cautions' => $request->cautions,
        'treatment_adjustments' => $request->treatment_adjustments
      ));

      $record_id = MedicalRecord::select('id')->orderBy('id','desc')->first();

      $length = count($request->minor_id);
      for($i=0 ; $i<$length ; $i++){
        DB::table('pe_records')->insert([
          'medical_record_id' => $record_id->id,
          'pe_minor_id' => $request->minor_id[$i],
          'value' => $request->value[$i]
        ]);
      }

      if($request->treatment_number == 1){
        $inj_date = DateTime::createFromFormat('d-m-Y', $request->injury_date);
        $injury_date = $inj_date->format('Y-m-d');
        DB::table('medical_firsts')->insert([
          'patient_id' => $request->patient_id,
          'medical_record_id' => $record_id->id,
          'injury_date' => $injury_date,
          'family_history' => $request->family_history,
          'infectious_disease' => $request->infectious_disease,
          'asthma' => $request->asthma,
          'cancer' => $request->cancer,
          'abnormal_blood_pressure' => $request->abnormal_blood_pressure,
          'heart_condition' => $request->heart_condition,
          'diabetes' => $request->diabetes,
          'mental_health_conditions' => $request->mental_health_conditions,
          'bleeding_disorders' => $request->bleeding_disorders,
          'epilepsy' => $request->epilepsy,
          'thyroid_diseases' => $request->thyroid_diseases,
          'surgery' => $request->surgery,
          'fractures' => $request->fractures,
          'taking_prescribed_medicine' => $request->taking_prescribed_medicine,
          'regularly_take_supplement' => $request->regularly_take_supplement,
          'full_details' => $request->full_details,
          'menstruation' => $request->menstruation
        ]);
      }

      return redirect('/patient/'.$request->patient_id);
      //return to review form on every 6 inserts of record
      /*if($request->treatment_number % 6 == 0){
        $patient = Patient::select('surname','last_name','DOB','gender')->where('id','=',$request->patient_id)->first();
        return view('/medical_record/create_review')->with('patient',$patient);
      }else{

      }*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $record = MedicalRecord::find($id);
        if($record->treatment_number == 1){
          $record = MedicalRecord::join('patients','medical_records.patient_id','=','patients.id')
              ->join('medical_firsts','medical_firsts.medical_record_id','=','medical_records.id')
              ->select('medical_records.*','medical_firsts.*','patients.surname','patients.last_name','patients.DOB')
              ->where('medical_records.id','=',$id)
              ->first();
          return view('/medical_record/print_first')->with('record',$record);
        }else{
          $record = MedicalRecord::join('patients','medical_records.patient_id','=','patients.id')
              ->select('medical_records.*','patients.surname','patients.last_name','patients.DOB')
              ->where('medical_records.id','=',$id)
              ->first();
          return view('/medical_record/print')->with('record',$record);
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $record = MedicalRecord::find($id);
        $pe_majors = DB::table('pe_majors')->get();
        $pe_minors = DB::table('pe_minors')->get();
        $pe_records = DB::table('pe_records')->where('medical_record_id','=',$id)->get();

        if($record->treatment_number == 1){
          //$physical = PhysicalExamination::get();
          $record = MedicalRecord::join('patients','medical_records.patient_id','=','patients.id')
              ->join('medical_firsts','medical_firsts.medical_record_id','=','medical_records.id')
              ->select('medical_records.id as record_id','medical_records.*','medical_firsts.*','patients.surname','patients.last_name','patients.DOB')
              ->where('medical_records.id','=',$id)
              ->first();
          $patient = Patient::select('surname','last_name','DOB')->where('id','=',$record->patient_id)->first();

          return view('/medical_record/edit_first')->with('record',$record)
                  ->with('pe_majors',$pe_majors)->with('pe_minors',$pe_minors)->with('pe_records',$pe_records)
                  ->with('patient',$patient);
        }else{
          //$physical = PhysicalExamination::get();
          $record = MedicalRecord::find($id);
          $patient = Patient::select('surname','last_name','DOB')->where('id','=',$record->patient_id)->first();

          return view('/medical_record/edit')->with('record',$record)
                ->with('pe_majors',$pe_majors)->with('pe_minors',$pe_minors)->with('pe_records',$pe_records)
                ->with('patient',$patient);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $cre_date = DateTime::createFromFormat('d-m-Y', $request->date);
      $date = $cre_date->format('Y-m-d');

      $MedicalRecords = MedicalRecord::find($id);
      $MedicalRecords->update([
        'patient_id' => $request->patient_id,
        'treatment_number' => $request->treatment_number,
        'main_complaint' => $request->main_complaint,
        'symptoms' => $request->symptoms,
        'general_question' => $request->general_question,
        'physical_examinations' => $request->physical_examinations,
        'tongue_status' => $request->tongue_status,
        'body_colour' => $request->body_colour,
        'shape' => $request->shape,
        'movement' => $request->movement,
        'proper_of_coating' => $request->proper_of_coating,
        'coating_colour' => $request->coating_colour,
        'pulses' => $request->pulses,
        'lung_qi' => $request->lung_qi,
        'heart_blood' => $request->heart_blood,
        'spleen' => $request->spleen,
        'liver' => $request->liver,
        'kidney_yang' => $request->kidney_yang,
        'kidney_yin' => $request->kidney_yin,
        'TCM_disease' => $request->TCM_disease,
        'TCM_type' => $request->TCM_type,
        'treatment_principle' => $request->treatment_principle,
        'Acu_points' => $request->Acu_points,
        'treatment_explanation' => $request->treatment_explanation,
        'cautions' => $request->cautions,
        'treatment_adjustments' => $request->treatment_adjustments,
        //20161003 modify timestamp
        'date' => $date
      ]);


      $del_pe = DB::table('pe_records')->where('medical_record_id','=',$id)->delete();

      $length = count($request->minor_id);
      for($i=0 ; $i<$length ; $i++){
          DB::table('pe_records')->insert([
            'medical_record_id' => $id,
            'pe_minor_id' => $request->minor_id[$i],
            'value' => $request->value[$i]
          ]);

      }

      if($request->treatment_number == 1){
        $inj_date = DateTime::createFromFormat('d-m-Y', $request->injury_date);
        $injury_date = $inj_date->format('Y-m-d');
        DB::table('medical_firsts')->where('medical_record_id', $id)
          ->update([
          'injury_date' => $injury_date,
          'family_history' => $request->family_history,
          'infectious_disease' => $request->infectious_disease,
          'asthma' => $request->asthma,
          'cancer' => $request->cancer,
          'abnormal_blood_pressure' => $request->abnormal_blood_pressure,
          'heart_condition' => $request->heart_condition,
          'diabetes' => $request->diabetes,
          'mental_health_conditions' => $request->mental_health_conditions,
          'bleeding_disorders' => $request->bleeding_disorders,
          'epilepsy' => $request->epilepsy,
          'thyroid_diseases' => $request->thyroid_diseases,
          'surgery' => $request->surgery,
          'fractures' => $request->fractures,
          'taking_prescribed_medicine' => $request->taking_prescribed_medicine,
          'regularly_take_supplement' => $request->regularly_take_supplement,
          'full_details' => $request->full_details,
          'menstruation' => $request->menstruation
        ]);
      }

      return redirect('/patient/'.$request->patient_id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $del = MedicalRecord::find($id);
      if($del->treatment_number == 1){
        DB::table('medical_firsts')->where('medical_record_id', '=', $id)->delete();
      }
      $patient_id = $del->patient_id;
      $del_pe = DB::table('pe_records')->where('medical_record_id','=',$id)->delete();

      return redirect('/patient/'.$patient_id)->with('message', 'Deleted!');
    }
}
