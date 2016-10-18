<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DateTime;
use App\Patient;
use App\MedicalRecord;
use DB;

class PatientController extends Controller
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

    public function index($type)
    {
      //get the array to check if the acc_infos table contains the patient
      $acc_id = DB::table('acc_infos')->select('patient_id')->distinct()->get();
      $id = array();
      foreach($acc_id as $a){
        array_push($id,$a->patient_id);
      }

      if($type == "acc"){
        $records = Patient::whereIn('id',$id)->orderBy('id')->get();
      }elseif($type == "nonacc"){
        $records = Patient::whereNotIn('id',$id)->orderBy('id')->get();
      }
      return view('/patient/records')->with('records',$records)->with('type',$type);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('/patient/create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $DOB = DateTime::createFromFormat('d-m-Y', $request->DOB);
      $Patient = Patient::create(
        array(
          'patient_code' => $request->patient_code,
          'surname' => $request->surname,
          'last_name' => $request->last_name,
          'phone' => $request->phone,
          'cell_phone' => $request->cell_phone,
          'DOB' => $DOB->format('Y-m-d'),
          'gender' => $request->gender,
          //'acc' => $request->acc,
          //'acc_number' => $request->acc_number,
          'address' => $request->address,
          'blood_type' => $request->blood_type
      ));
      $id = Patient::select('id')->orderBy('id','desc')->first();

      $length = count($request->acc_number);
      for($i=0 ; $i<$length ; $i++){
        $acc_number = DB::table('acc_infos')->insert(array(
          'patient_id' => $id->id,
          'acc_number' => $request->acc_number[$i],
          'parts'=> $request->acc_part[$i],
        ));
      }

      return redirect('/patient/'.$id->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $patient = Patient::find($id);
      $records = MedicalRecord::where('patient_id','=',$id)->orderBy('id','desc')->get();

      $reviews = DB::table('medical_reviews')->where('patient_id','=',$id)->get();
      $acc_infos = DB::table('acc_infos')->where('patient_id','=',$id)->get();
      return view('/patient/show')->with('patient',$patient)->with('records',$records)
          ->with('reviews',$reviews)->with('acc_infos',$acc_infos);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patient = Patient::find($id);
        $acc_infos = DB::table('acc_infos')->where('patient_id','=',$id)->get();
        return view('/patient/edit')->with('patient',$patient)->with('acc_infos',$acc_infos);
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
      $list = Patient::findOrFail($id);
      $DOB = DateTime::createFromFormat('d-m-Y', $request->DOB);

      $list->update([
        'patient_code' => $request->patient_code,
        'surname' => $request->surname,
        'last_name' => $request->last_name,
        'phone' => $request->phone,
        'cell_phone' => $request->cell_phone,
        'DOB' => $DOB->format('Y-m-d'),
        'gender' => $request->gender,
        //'acc' => $request->acc,
        //'acc_number' => $request->acc_number,
        'address' => $request->address,
        'blood_type' => $request->blood_type
      ]);
      //acc records cant be modified
      /*
      DB::table('acc_infos')->where('patient_id','=', $id)->delete();
      */
      $length = count($request->acc_number);
      for($i=0 ; $i<$length ; $i++){
        $acc_number = DB::table('acc_infos')->insert(array(
          'patient_id' => $id,
          'acc_number' => $request->acc_number[$i],
          'parts'=> $request->acc_part[$i],
        ));
      }

      return redirect('/patient/'.$id)->with('message','Updated !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $del = Patient::find($id);
      $del->delete();
      $if_acc = DB::table('acc_infos')->where('patient_id', '=', $id)->count();
      DB::table('acc_infos')->where('patient_id', '=', $id)->delete();

      if($if_acc > 0){
        return redirect('/patient_index/acc')->with('message', 'Deleted!');
      }else{
        return redirect('/patient_index/nonacc')->with('message', 'Deleted!');
      }
    }
}
