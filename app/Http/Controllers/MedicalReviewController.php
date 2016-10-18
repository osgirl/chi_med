<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\MedicalRecord;
use App\Patient;
use DB;

class MedicalReviewController extends Controller
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

    public function index($record_id)
    {
      $patient = MedicalRecord::join('patients','patients.id','=','medical_records.patient_id')
        ->select('medical_records.treatment_number','medical_records.acc_id','patients.id','patients.surname','patients.last_name','patients.DOB','patients.gender')
        ->where('medical_records.id','=',$record_id)->first();
      $previous_info = MedicalRecord::where('acc_id','=',$patient->acc_id)
        ->whereBetween('treatment_number',[$patient->treatment_number-5,$patient->treatment_number])->get();
      return view('/medical_record/create_review')->with('patient',$patient)->with('previous_info',$previous_info);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $MedicalReviews = DB::table('medical_reviews')->insert(
      array(
        'patient_id' => $request->patient_id,
        'acc_id' => $request->acc_id,
        'treatment_number' => $request->treatment_number,
        'summary' => $request->summary,
        'investigation' => $request->investigation,
        'outcomes' => $request->outcomes,
        'differential_diagnosis' => $request->differential_diagnosis,
        'treatment' => $request->treatment,
        'discussion' => $request->discussion,
        'create_date' => date("Y-m-d H:i:s")
      ));

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
      $record = DB::table('medical_reviews')->join('patients','medical_reviews.patient_id','=','patients.id')
          ->select('medical_reviews.*','patients.surname','patients.last_name','patients.DOB','patients.gender')
          ->where('medical_reviews.id','=',$id)
          ->first();

      return view('/medical_record/print_review')->with('record',$record);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $patient = DB::table('medical_reviews')->join('patients','patients.id','=','medical_reviews.patient_id')
        ->select('medical_reviews.id','patients.id as patient_id','patients.surname','patients.last_name','patients.DOB','patients.gender')
        ->where('medical_reviews.id','=',$id)->first();
      $records = DB::table('medical_reviews')->find($id);

      $previous_info = MedicalRecord::where('acc_id','=',$records->acc_id)
        ->whereBetween('treatment_number',[$records->treatment_number-5,$records->treatment_number])->get();
      return view('/medical_record/edit_review')->with('patient',$patient)
        ->with('records',$records)->with('previous_info',$previous_info);
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
        DB::table('medical_reviews')->where('id', $id)
            ->update([
              'summary' => $request->summary,
              'investigation' => $request->investigation,
              'outcomes' => $request->outcomes,
              'differential_diagnosis' => $request->differential_diagnosis,
              'treatment' => $request->treatment,
              'discussion' => $request->discussion,
              'create_date' => date("Y-m-d H:i:s")
            ]);

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
      $del = DB::table('medical_reviews')->select('patient_id')->where('id', '=', $id)->first();
      $patient_id = $del->patient_id;
      DB::table('medical_reviews')->where('id', '=', $id)->delete();

      return redirect('/patient/'.$patient_id)->with('message', 'Deleted!');
    }
}
