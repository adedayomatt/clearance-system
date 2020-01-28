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

Route::get('/', 'ApplicationController@home')->name('home');


// admin routes
Route::get('admin/login', 'Auth\AdminController@loginForm')->name('admin.login.form');
Route::post('admin/login', 'Auth\AdminController@login')->name('admin.login');
Route::post('admin/logout', 'Auth\AdminController@logout')->name('admin.logout');

Route::group(['middleware' => 'auth:admin', 'prefix' => 'admin'], function(){
    Route::get('/', 'AdminController@index')->name('admin.index');
    Route::get('/prospects', 'ProspectController@index')->name('admin.prospects');
    Route::get('/clearances', 'ClearanceController@index')->name('admin.clearances');
    Route::get('/clearance-stages', 'ClearanceStageController@index')->name('admin.clearance.stages');

    Route::get('/', 'AdminController@index')->name('admin.index');
});


// student routes
Auth::routes();
Route::get('check-matric', 'StudentController@checkMatric')->name('student.matric.check');
Route::post('check-matric', 'StudentController@confirmMatric')->name('student.matric.confirm');
Route::get('{matric}/start', 'StudentController@startClearance')->name('student.clearance.start');
Route::post('{matric}/start', 'StudentController@registerClearance')->name('student.clearance.register');

Route::group(['middleware' => 'auth:web'], function(){

});