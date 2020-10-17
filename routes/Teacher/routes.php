<?php

use Illuminate\Support\Facades\Route;
## Teacher Routes
Route::group(['namespace' => 'Teacher','prefix' => 'teacher'],function(){

    Route::GET('login','loginController@showLoginForm')->name('TeacherLogin');
    Route::post('login','loginController@login')->name('teacher.login');



Route::group(['middleware' => ['assign.guard:teacher']],function(){

######### Start Students Section
    Route::get('/','StudentController@index')->name('teacher.students');
    Route::post('TStudent','StudentController@level')->name("Tstudent.level");

######### End Students Section

######### Start Assignments Section
Route::get('Assignments','AssignmentController@index')->name('teacher.assignments');
Route::post('AssignmentCreate','AssignmentController@store')->name("teacher.assignments.create");
Route::get('assignmentDown/{file}','AssignmentController@downlaod')->name('download.assignment');
Route::post('assignmentDel','AssignmentController@destroy')->name("assignment.delete");

######### End Assignments Section

});



});
