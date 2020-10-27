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

######### Start Exams Section
Route::get('Exams','ExamController@index')->name('teacher.exams');
Route::post('ExamCreate','ExamController@store')->name("teacher.exam.create");
Route::post('ExamDel','ExamController@destroy')->name("Exam.delete");
######### End Exams Section

######### Start Results Section
Route::get('Results','AnswerController@index')->name("Exam.results");
Route::get('Result/{exam}-{slug}', 'AnswerController@show')->name('exam.result.show');
Route::get('Sresult/{exam}','AnswerController@userAnswer')->name('teacher.student.result');
Route::post('ResultMark','AnswerController@mark')->name('teacher.exam.mark.update');

######### End Results Section

###### Activity
Route::get('Activity','AssignmentController@Activity')->name("Activity");

});



});
