<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function test(){
      $original = DB::table('patients')->select('id','acc_number')
          ->whereNotNull('acc_number')->distinct()->get();

      foreach ($original as $o) {
        $acc_number = DB::table('acc_infos')->insert(array(
          'patient_id' => $o->id,
          'acc_number' => $o->acc_number,
        ));
      }

      $acc_infos = DB::table('acc_infos')->select('id','patient_id')->get();
      $records = DB::table('medical_records')->select('id','patient_id')->get();

      foreach ($records as $record) {
        foreach ($acc_infos as $acc) {
          if($acc->patient_id == $record->patient_id){
            DB::table('medical_records')
            ->where('id', $record->id)
            ->update(array('acc_id' => $acc->id));
          }
        }
      }
    }
}
