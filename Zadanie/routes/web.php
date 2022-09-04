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

Route::get('/', 'MainController@home' )->name('home');

Route::get('/StudCreate', 'MainController@about')->name('StudCreate');

Route::post('/StudCreate/Check', 'MainController@Stud_check');

Route::post('/StudDelete/Check', 'MainController@Stud_delete');

Route::get('/SubjectCreate', 'MainController@Subject')->name('SubjectCreate');

Route::post('/SubjectCreate/Check', 'MainController@Subject_check');

Route::post('/SubjectDelete/Check', 'MainController@Subject_delete');

Route::get('/connectionID', 'MainController@connectionID')->name('connectionID');;

Route::post('/connectionID/Check', 'MainController@connectionID_check');

Route::post('/connectionIDDelete/Check', 'MainController@connectionID_delete');

Route::get('/searchBySubject', 'MainController@searchBySubject')->name('searchBySubject');

Route::post('/searchBySubject/Check', 'MainController@searchBySubject_check');

Route::get('/Grade', 'MainController@Grade')->name('Grade');

Route::post('/Grade/Check', 'MainController@Grade_check');


Route::post('/sendName' ,'MainController@sendName','sendName');
Route::post('/deleteName' ,'MainController@deleteName','deleteName');
Route::get('/showTable' ,'MainController@showTable','showTable');
Route::get('/showTableConnection' ,'MainController@showTableConnection','showTableConnection');
Route::get('/showTableSubj' ,'MainController@showTableSubj','showTableSubj');

Route::post('/createConnection' ,'MainController@createConnection','createConnection');
Route::post('/deleteConnection' ,'MainController@deleteConnection','deleteConnection');

Route::post('/GradeSelect' ,'MainController@GradeSelect','GradeSelect');

Route::post('/searchBySubjectTable' ,'MainController@searchBySubjectTable','searchBySubjectTable');

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');


