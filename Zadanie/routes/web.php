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

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');


