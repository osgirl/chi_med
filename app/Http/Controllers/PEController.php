<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Image;
use File;

class PEController extends Controller
{
    public function __construct()
    {
      $this->middleware('permission:admin');
    }

    public function index(){
      $majors = DB::table('pe_majors')->get();
      $minors = DB::table('pe_minors')->get();
      return view('physical/index')->with('majors',$majors)->with('minors',$minors);
    }

    public function addMajor(Request $request){
      DB::table('pe_majors')->insert([
        'part' => $request->part
      ]);

      return redirect('/physical');
    }

    public function deleteMajor(Request $request,$id){

      $file = DB::table('pe_minors')->where('major_id', '=', $id)->get();
      foreach ($file as $key => $f) {
        File::delete($f->img_url);
        DB::table('pe_records')->where('pe_minor_id', '=', $f->id)->delete();
      }
      DB::table('pe_minors')->where('major_id', '=', $id)->delete();
      DB::table('pe_majors')->where('id', '=', $id)->delete();

      return redirect('/physical');
    }

    public function addMinor(Request $request,$major_id){

      if (!file_exists('img/PE')) {
        mkdir('img/PE', 0777, true);
      }
      $img = Image::make($_FILES['fileToUpload']['tmp_name']);
      $destinationPath = 'img/PE/'.$_FILES['fileToUpload']['name'];
      // save image
      $img->save($destinationPath);
      DB::table('pe_minors')->insert(
        [
          'major_id' => $major_id,
          'description' => $request->description,
          'img_url' => $destinationPath
        ]
      );

      return redirect('/physical');
    }

    public function updateMinor(Request $request,$id){

      $file = DB::table('pe_minors')->where('id', '=', $id)->first();
      File::delete($file->img_url);
      DB::table('pe_minors')->where('id', '=', $id)->delete();

      $img = Image::make($_FILES['fileToUpload']['tmp_name']);
      $destinationPath = 'img/PE/'.$_FILES['fileToUpload']['name'];
      // save image
      $img->save($destinationPath);
      DB::table('pe_minors')->insert(
        [
          'major_id' => $request->major_id,
          'description' => $request->description,
          'img_url' => $destinationPath
        ]
      );

      return redirect('/physical');
    }

    public function deleteMinor(Request $request,$id){

      $file = DB::table('pe_minors')->where('id', '=', $id)->first();
      File::delete($file->img_url);
      DB::table('pe_minors')->where('id', '=', $id)->delete();

      return redirect('/physical');
    }

}
