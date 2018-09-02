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
Route::get('/courses/{alias}', 'CourseController@showCourse')->name('course.show');


Route::middleware(['auth'])->group(function() {
	
	Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
	Route::post('/courses/{alias}', 'CourseController@applyCourse');
	Route::get('/learn', 'User\HomeController@index')->name('learn');
	
});


Route::middleware(['auth', 'student'])->prefix('courses')->namespace('User')->group(function() {
	
	Route::middleware(['course.allowed'])->group(function() {
		Route::get('/{alias}/menu', 'CourseMenuController@showMenu')->name('course.show.menu');
		Route::get('/{alias}/run', 'CourseMenuController@runCourse')->name('course.run');
		
		Route::get('/{alias}/topics', 'CourseMenuController@showTopics')->name('course.show.topics');
		Route::get('/{alias}/topics/{topic_alias}', 'TopicController@showTopic')->name('course.show.topic');
		Route::get('/{alias}/topics/{topic_alias}/{page_number}', 'PageController@showPage')->name('course.show.page');
		
		Route::get('/{alias}/assignments', 'CourseMenuController@showAssignments')->name('course.show.assignments');
		Route::get('/{alias}/assignments/{assignment_alias}', 'AssignmentController@run')->name('assignment.run');
		Route::post('/{alias}/assignments/{assignment_alias}', 'AssignmentController@submit');
		Route::get('/{alias}/assignments/{assignment_alias}/result', 'AssignmentController@showResult')->name('assignment.show.result');
		
		Route::get('/{alias}/resources', 'CourseMenuController@showResources')->name('course.show.resources');
		Route::get('/{alias}/results', 'CourseMenuController@showResults')->name('course.show.results');
	
	});
});

Route::middleware(['auth', 'teacher'])->prefix('teacher')->namespace('Teacher')->group(function() {
	Route::resource('courses', 'CourseController', ['as' => 'teacher']);
});

Route::middleware(['auth', 'teacher'])->prefix('teacher/courses/{course_alias}')->namespace('Teacher')->group(function() {
	Route::post('topics/{topic}/changeOrder', 'TopicController@changePagePosition');
	Route::post('topics/changeOrder', 'TopicController@changeTopicPosition');
	Route::resource('topics', 'TopicController', ['as' => 'teacher']);
});

Route::middleware(['auth', 'teacher'])
	->prefix('teacher/courses/{course_alias}/topics/{topic}')->namespace('Teacher')->group(function() {
			
		Route::resource('pages', 'PageController', ['as' => 'teacher'])->except([
	    	'index'
		]);;
		
});


/*Route::group(['prefix'=>'admin', 'middleware'=>'auth', 'middleware'=>'admin'], function(){
	
	Route::get('/', 'Admin\HomeController@index')->name('admin');
	
});*/



Auth::routes();
