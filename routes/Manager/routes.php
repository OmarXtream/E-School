<?php

use Illuminate\Support\Facades\Route;
## Manager Routes
Route::group(['namespace' => 'Manager','prefix' => 'manager'],function(){

    Route::GET('login','loginController@showLoginForm')->name('ManagerLogin');
    Route::post('login','loginController@login')->name('manager.login');



Route::group(['middleware' => ['assign.guard:manager,manager/login']],function(){
    Route::get('/',function(){
        return view('manager.home');
        });


});



});
