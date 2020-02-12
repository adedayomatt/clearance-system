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

// requires admin authentication
Route::group(['middleware' => 'auth:admin', 'prefix' => 'admin'], function(){
    Route::get('/', 'AdminController@index')->name('admin.index');
    Route::get('/prospects', 'ProspectController@index')->name('admin.prospects');
    Route::get('/prospects/import', 'ProspectController@initiateImport')->name('admin.prospects.import.initiate');
    Route::post('/prospects/import', 'ProspectController@import')->name('admin.prospects.import');

    Route::get('/clearances', 'ClearanceController@index')->name('admin.clearances');
    Route::get('/clearance/{id}', 'ClearanceController@index')->name('admin.clearance.show');

    Route::get('/student/{matric}', 'StudentController@show')->name('admin.student.show');

    Route::get('/clearance-stages', 'ClearanceStageController@index')->name('admin.clearance.stages');
    Route::get('/clearance-stage/create', 'ClearanceStageController@create')->name('admin.clearance.stage.create');
    Route::post('/clearance-stage/create', 'ClearanceStageController@store')->name('admin.clearance.stage.store');
    Route::get('/clearance-stage/{id}/edit', 'ClearanceStageController@edit')->name('admin.clearance.stage.edit');
    Route::put('/clearance-stage/{id}/edit', 'ClearanceStageController@update')->name('admin.clearance.stage.update');
    
    Route::get('/clearance-stage/{id}/requirements/create', 'RequirementController@create')->name('admin.requirement.create');
    Route::post('/clearance-stage/{id}/requirements/create', 'RequirementController@store')->name('admin.requirement.store');
    Route::get('/requirements/{id}/edit', 'RequirementController@edit')->name('admin.requirement.edit');
    Route::put('/requirements/{id}/edit', 'RequirementController@update')->name('admin.requirement.update');

    Route::get('/clearance-stage/{id}/student/{matric}', 'ClearanceStageController@studentClearance')->name('admin.student.stage.clearance');
    Route::get('clearance/{id}', 'ClearanceController@show')->name('admin.clearance.show');
    Route::put('clearance/{id}/approve', 'ClearanceController@approveClearance')->name('admin.clearance.approve');
    Route::put('clearance/{id}/reject', 'ClearanceController@rejectClearance')->name('admin.clearance.reject');

    Route::get('forms', 'FormController@index')->name('admin.forms');
    Route::get('form/create', 'FormController@create')->name('admin.form.create');
    Route::post('form/store', 'FormController@store')->name('admin.form.store');
    Route::put('form/{id}/edit', 'FormController@edit')->name('admin.form.edit');
    Route::delete('form/{id}/delete', 'FormController@delete')->name('admin.form.delete');

    Route::get('form/{id}/field/create', 'FormFieldController@create')->name('admin.form.field.create');
    Route::post('form/{id}/field/store', 'FormFieldController@store')->name('admin.form.field.store');
    Route::get('field/{id}/edit', 'FormFieldController@edit')->name('admin.form.field.edit');
    Route::put('field/{id}/update', 'FormFieldController@update')->name('admin.form.field.update');
    Route::delete('field/{id}/delete', 'FormFieldController@delete')->name('admin.form.field.delete');

});

Route::group(['middleware' => 'admin-and-student'], function(){
    Route::get('form/{form}', 'FormController@show')->name('form.show');
    Route::get('requirement/{requirement}/form/{form}', 'FormController@requirementFormShow')->name('requirement.form.show');
});


// student routes
Auth::routes();
Route::get('check-matric', 'ClearanceAuthenticationController@checkMatric')->name('student.matric.check');
Route::post('check-matric', 'ClearanceAuthenticationController@confirmMatric')->name('student.matric.confirm');
Route::get('{matric}/start', 'ClearanceAuthenticationController@startClearance')->name('student.clearance.start');
Route::post('{matric}/start', 'ClearanceAuthenticationController@registerClearance')->name('student.clearance.register');

// requires student authentication
Route::group(['middleware' => 'auth:web', 'prefix' => 'clearance'], function(){
    Route::get('/', 'StudentController@index')->name('student.index');
    Route::get('{id}', 'ClearanceController@show')->name('clearance.show');

    Route::post('stage/{stage}/form/{form}/submit', 'ClearanceController@submitForm')->name('form.submit');

    Route::post('requirement/{id}/upload', 'ClearanceController@uploadRequirement')->name('requirement.upload');
    Route::post('certificate', 'StudentController@printCertificate')->name('student.clearance.certificate');
    
});

Route::get('/clearance-stage/{id}', 'ClearanceStageController@show')->name('clearance.stage.show');
Route::get('/requirement/{id}', 'RequirementController@show')->name('requirement.show');
