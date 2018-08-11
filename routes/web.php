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

Route::get('/', 'IndexController@index')->name('index');
Route::get('/courses', 'CourseController@listCourses')->name('courses');
Route::get('/course/{alias}', 'CourseController@showCourse')->name('course.show');


Route::middleware(['auth'])->group(function() {
	
	Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
	Route::post('/course/{alias}', 'CourseController@applyCourse');
	Route::get('/home', 'HomeController@index')->name('home');
	
});


Route::middleware(['auth', 'student'])->group(function() {
	
	
	Route::get('/learn', 'HomeController@showCourses')->name('learn');
	
	
});


Route::group(['prefix'=>'teacher', 'middleware'=>'auth', 'middleware'=>'teacher'], function(){
	
	Route::get('/', 'Teacher\HomeController@index')->name('teacher');
	Route::get('/teach', 'Teacher\HomeController@showCourses')->name('teach');
	Route::get('/course-add', 'Teacher\HomeController@addCourse')->name('course.add');
	
});


Route::group(['prefix'=>'admin', 'middleware'=>'auth', 'middleware'=>'admin'], function(){
	
	Route::get('/', 'Admin\HomeController@index')->name('admin');
	
});



Auth::routes();
