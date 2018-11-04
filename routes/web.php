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

Route::get('/', function () {
    return view('home');
})->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('classifications', 'ClassificationsController');
Route::resource('diseases', 'DiseasesController');
Route::resource('patients', 'PatientsController');
Route::get('/recaps/dataKesakitan', 'RecapsController@dataKesakitan')->name('dataKesakitan');
Route::get('/recaps/topTen', 'RecapsController@topTen')->name('topTen');

Route::get('/recaps/download', 'RecapsController@exportPatient')->name('exportPatient');
Route::get('/recaps/query', 'RecapsController@checkQuery')->name('checkQuery');
Route::post('/recaps/testForm', 'RecapsController@testForm')->name('testForm');
