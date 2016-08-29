<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DateTime;
use App\Patient;
use App\MedicalRecord;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type)
    {
      if($type == "acc"){
        $records = Patient::where('acc','=',true)->orderBy('id')->get();
      }elseif($type == "nonacc"){
        $records = Patient::where('acc','=',false)->orderBy('id')->get();
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
          'acc' => $request->acc,
          'acc_number' => $request->acc_number,
          'address' => $request->address,
          'blood_type' => $request->blood_type
      ));

      $id = Patient::select('id')->orderBy('id','desc')->first();
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
      $records = MedicalRecord::where('patient_id','=',$id)->get();
      return view('/patient/show')->with('patient',$patient)->with('records',$records);
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
        return view('/patient/edit')->with('patient',$patient);
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
        'acc' => $request->acc,
        'acc_number' => $request->acc_number,
        'address' => $request->address,
        'blood_type' => $request->blood_type
      ]);
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
      $patient_type = $del->acc;
      $del->delete();

      if($patient_type == 1){
        return redirect('/patient_index/acc')->with('message', 'Deleted!');
      }else{
        return redirect('/patient_index/nonacc')->with('message', 'Deleted!');
      }
    }
}
