<?php

use Illuminate\Support\Facades\Route;
## Manager Routes
Route::group(['namespace' => 'Manager','prefix' => 'manager'],function(){

    Route::GET('login','loginController@showLoginForm')->name('ManagerLogin');
    Route::post('login','loginController@login')->name('manager.login');



Route::group(['middleware' => ['assign.guard:manager']],function(){

########## Start Teacher's Routes

    Route::get('/','TeacherController@index')->name('teacher.index');
    Route::post('TeacherCreate','TeacherController@store')->name("teacher.create");
    Route::post('Teacherdelete','TeacherController@destroy')->name("teacher.delete");

########## End Teacher's Routes

########## Start Student's Routes

Route::get('students','StudentController@index')->name('student.index');
// Route::post('StudentCreate','StudentController@store')->name("student.create");
// Route::post('Teacherdelete','StudentController@destroy')->name("student.delete");

########## End Student's Routes


########## Start Keys Routes

    Route::get('keys',"KeyController@index")->name('keys.index');
    Route::post('KeyCreate','KeyController@store')->name("keys.create");
    Route::post('Keydelete','KeyController@destroy')->name("keys.delete");

########## End Keys Routes






});



});
