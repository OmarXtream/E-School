<?php

use Illuminate\Support\Facades\Route;
## Teacher Routes
Route::group(['namespace' => 'Teacher','prefix' => 'teacher'],function(){

    Route::GET('login','loginController@showLoginForm')->name('TeacherLogin');
    Route::post('login','loginController@login')->name('teacher.login');



Route::group(['middleware' => ['assign.guard:teacher']],function(){

######### Start Students Section
    Route::get('/','StudentController@index');
    Route::post('TStudent','StudentController@level')->name("Tstudent.level");

######### End Students Section


});



});
