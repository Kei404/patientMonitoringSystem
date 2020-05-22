<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Welcome
Auth::routes();
Route::get('/', function () { return view('welcome'); });

// Dashboard
Route::get('/dashboard', 'Admin\DashboardController@dashboard');

// Patients Controller
Route::get('/patient/create', 'Admin\CreateController@index');
Route::post('/patient/store', 'Admin\CreateController@store');

Route::get('/patient/edit/{id}', 'Admin\CreateController@edit');
Route::post('/patient/update', 'Admin\CreateController@update');

Route::get('/patient/list', 'Admin\CreateController@registered');
Route::delete('/patient/delete/patient_id','Admin\CreateController@destroy');
Route::get('/patient/profile/{id}', 'Admin\CreateController@profile');

// Vitals Controller
Route::post('/vitals/store', 'Data\VitalsController@store');
Route::get('/vitals', 'Admin\CreateController@apivitals');

// Refresh TableHistory
Route::get('/vitalrefresh/{id}', 'Admin\CreateController@refreshHistory');
Route::delete('/delete/history_id','Admin\CreateController@destroyHistory');
