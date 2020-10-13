<?php

use Illuminate\Support\Facades\Route;
## Manager Routes
Route::group(['namespace' => 'Manager','prefix' => 'manager'],function(){

    Route::GET('login','loginController@showLoginForm')->name('ManagerLogin');
    Route::post('login','loginController@login')->name('manager.login');



Route::group(['middleware' => ['assign.guard:manager']],function(){
    Route::get('/',function(){
        return view('manager.home');
        });

########## Start Keys Routes

    Route::get('keys',"KeyController@index")->name('keys.index');
    Route::post('KeyCreate','KeyController@store')->name("keys.create");
    Route::get('delete/{id}','KeysController@destroy')->name("keys.delete");

########## End Keys Routes






});



});
