<?php

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

Route::get('/', 'RecapsController@topTenChart')->name('topTenChart')->middleware('auth');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'RecapsController@topTenChart')->name('topTenChart')->middleware('auth');
Route::resource('classifications', 'ClassificationsController');
Route::resource('diseases', 'DiseasesController');
Route::resource('patients', 'PatientsController');

Route::get('/recaps/dataKesakitan', 'RecapsController@dataKesakitan')->name('dataKesakitan');

//Route::get('/recaps/topTen/{year}/{month}', 'RecapsController@topTen')->name('topTen');
Route::get('/recaps/topTen/', 'RecapsController@topTen')->name('topTen');
Route::post('/recaps/topTen/redirect', 'RecapsController@topTenRedirect')->name('topTenRedirect');
Route::post('/recaps/topTen/download', 'RecapsController@topTenExport')->name('topTenExport');

Route::get('/recaps/treatmentRegistration/', 'RecapsController@treatmentRegistration')->name('treatmentRegistration');
Route::post('/recaps/treatmentRegistration/redirect', 'RecapsController@treatmentRegistrationRedirect')->name('treatmentRegistrationRedirect');
Route::post('/recaps/treatmentRegistration/download', 'RecapsController@treatmentRegistrationExport')->name('treatmentRegistrationExport');

Route::get('/recaps/pelayananPerawatan', 'RecapsController@treatmentRecaps')->name('treatmentRecaps');
Route::post('/recaps/pelayananPerawatan/download', 'RecapsController@treatmentRecapsExport')->name('treatmentRecapsExport');

Route::get('/recaps/download', 'RecapsController@exportPatient')->name('exportPatient');
Route::post('/recaps/downloadCountRecap', 'RecapsController@downloadCountRecap')->name('downloadCountRecap');

//SANDBOX
Route::post('/recaps/requestSandbox', 'RecapsController@requestSandbox')->name('requestSandbox');
Route::get('/recaps/querySandbox', 'RecapsController@querySandbox')->name('querySandbox');
