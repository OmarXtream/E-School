<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

######## Assignments Start
Route::get('/home', 'HomeController@index')->name('home');
Route::get('homeworks', 'HomeController@homeworks')->name('homeworks');
Route::get('Assignments/{assignment}-{slug}', 'HomeController@show')->name('lecture.show');
Route::get('assignmentDown/{file}','HomeController@downlaod')->name('student.download.assignment');

######## Assignments End
# Start Contact
Route::get('contact', 'HomeController@contact')->name('contact');

#End Contact

######## Exam's Start
Route::get('exams', 'ExamController@exams')->name('Exams');
Route::get('Exams/{exam}-{slug}', 'ExamController@show')->name('exam.show');
Route::post('ExamFinsh','ExamController@store')->name("student.exam.store");


######## Exam's End


