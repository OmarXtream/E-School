<?php

use Illuminate\Support\Facades\Route;
## Manager Routes
Route::group(['namespace' => 'Manager','prefix' => 'manager'],function(){

    Route::GET('login','LoginController@showLoginForm')->name('ManagerLogin');
    Route::post('login','LoginController@login')->name('manager.login');



Route::group(['middleware' => ['assign.guard:manager']],function(){

########## Start Teacher's Routes

    Route::get('/','TeacherController@index')->name('teacher.index');
    Route::post('TeacherCreate','TeacherController@store')->name("teacher.create");
    Route::post('Teacherdelete','TeacherController@destroy')->name("teacher.delete");
    Route::post('TeacherUpdate','TeacherController@update')->name("teacher.update");

########## End Teacher's Routes

########## Start Student's Routes

Route::get('students','StudentController@index')->name('student.index');
Route::post('StudentLevel','StudentController@level')->name("student.level");

########## End Student's Routes


########## Start Keys Routes

    Route::get('keys',"KeyController@index")->name('keys.index');
    Route::post('KeyCreate','KeyController@store')->name("keys.create");
    Route::post('Keydelete','KeyController@destroy')->name("keys.delete");

########## End Keys Routes






});



});
