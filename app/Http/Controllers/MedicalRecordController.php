<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Patient;
use App\MedicalRecord;
use App\PhysicalExamination;
use App\PE_Record;
use Datetime;

class MedicalRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($patient)
    {
        $patient = Patient::find($patient);
        $physical = PhysicalExamination::get();
        return view('medical_record/create')
        ->with('patient',$patient)->with('physical',$physical);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $date = DateTime::createFromFormat('d-m-Y', $request->injury_date);
      $injury_date = $date->format('Y-m-d');
      $MedicalRecords = MedicalRecord::create(
      array(
        'patient_id' => $request->patient_id,
        'injury_date' => $injury_date,
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
        'Acu_points' => $request->Acu_points,
        'treatment_adjustments' => $request->treatment_adjustments
      ));
      $record_id = MedicalRecord::select('id')->orderBy('id','desc')->first();
      $length = count($request->physical_examination_id);
      for($i=0 ; $i<$length ; $i++){
        $PE = PE_Record::create(array(
          'medical_record_id' => $record_id->id,
          'physical_examination_id' => $request->physical_examination_id[$i],
          'direction1_value' => $request->direction1_value[$i],
          'direction2_value' => $request->direction2_value[$i]
        ));
      }
      return redirect('/patient/'.$request->patient_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $physical = PhysicalExamination::get();
        $record = MedicalRecord::find($id);
        $PE_records = PE_Record::join('physical_examinations', 'p_e__records.physical_examination_id', '=', 'physical_examinations.id')->where('medical_record_id','=',$id)->get();
        return view('/medical_record/edit')->with('record',$record)->with('PE_records',$PE_records)
              ->with('physical',$physical);
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
      $date = DateTime::createFromFormat('d-m-Y', $request->injury_date);
      $injury_date = $date->format('Y-m-d');
      $c_date = DateTime::createFromFormat('d-m-Y', $request->created_at);
      $created_at = $c_date->format('Y-m-d');

      $MedicalRecords = MedicalRecord::find($id);
      $MedicalRecords->update([
        'patient_id' => $request->patient_id,
        'injury_date' => $injury_date,
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
        'Acu_points' => $request->Acu_points,
        'treatment_adjustments' => $request->treatment_adjustments,
        //20161003 modify timestamp
        'created_at' => $created_at
      ]);

      $del_pe = PE_Record::where('medical_record_id','=',$id);
      $del_pe->delete();

      $length = count($request->physical_examination_id);
      for($i=0 ; $i<$length ; $i++){
        $PE = PE_Record::create(array(
          'medical_record_id' => $id,
          'physical_examination_id' => $request->physical_examination_id[$i],
          'direction1_value' => $request->direction1_value[$i],
          'direction2_value' => $request->direction2_value[$i]
        ));
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
      $patient_id = $del->patient_id;
      $del_PE = PE_Record::where('medical_record_id','=',$id)->delete();
      $del->delete();

      return redirect('/patient/'.$patient_id)->with('message', 'Deleted!');
    }
}
