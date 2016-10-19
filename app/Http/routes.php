<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::group(['middleware' => ['web','auth']], function () {

  Route::resource('/user', 'UserController');

  Route::resource('/physical', 'PhysicalExaminationController');

  Route::get('/home', 'HomeController@index');

  //Route::get('/test', 'HomeController@test');

  Route::resource('/medical_record', 'MedicalRecordController');

  Route::resource('/medical_review', 'MedicalReviewController');

  Route::get('/acc/finish/{acc_id}', 'AccController@finish');

  Route::get('/medical_review_create/{record_id}', 'MedicalReviewController@index');

  Route::resource('/patient', 'PatientController');

  Route::get('/medical_record/create/{patient}/{acc}', 'MedicalRecordController@create');

  Route::get('/patient_index/{type}', 'PatientController@index');

});
