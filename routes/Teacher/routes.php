<?php

use Illuminate\Support\Facades\Route;
## Teacher Routes
Route::group(['namespace' => 'Teacher','prefix' => 'teacher'],function(){

    Route::GET('login','loginController@showLoginForm')->name('TeacherLogin');
    Route::post('login','loginController@login')->name('teacher.login');



Route::group(['middleware' => ['assign.guard:teacher']],function(){
    Route::get('/',function(){
        return view('teacher.home');
        });


});



});
