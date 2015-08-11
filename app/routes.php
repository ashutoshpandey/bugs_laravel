<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@home');

Route::post('/is-valid-user', 'AuthenticationController@isValidUser');

Route::get('/user-section', 'UserController@userSection');
Route::get('/create-user', 'UserController@createUser');
Route::post('/save-user', 'UserController@saveUser');
Route::get('/edit-user/{id}', 'UserController@editUser');
Route::get('/remove-user/{id}', 'UserController@removeUser');
Route::post('/update-user', 'UserController@updateUser');
Route::get('/list-users', 'UserController@listUsers');
Route::get('/profile', 'UserController@profile');
Route::post('/update-profile', 'UserController@updateProfile');

Route::get('/create-project', 'ProjectController@createProject');
Route::post('/save-project', 'ProjectController@saveProject');
Route::get('/edit-project/{id}', 'ProjectController@editProject');
Route::post('/update-project', 'ProjectController@updateProject');
Route::get('/remove-project/{id}', 'ProjectController@removeProject');
Route::get('/list-projects', 'ProjectController@listProjects');

Route::get('/create-bug', 'BugController@createBug');
Route::post('/save-bug', 'BugController@saveBug');
Route::get('/edit-bug/{id}', 'BugController@editBug');
Route::post('/update-bug', 'BugController@updateBug');
Route::get('/list-bugs/{id}', 'BugController@listBugs');
Route::post('/save-bug-comment', 'BugController@saveBugComment');
Route::get('/bug-detail/{id}', 'BugController@bugDetail');
Route::get('/download-bug', 'BugController@downloadBug');
Route::post('/change-bug-status', 'BugController@changeBugStatus');

Route::get('/data-list-projects', 'ProjectController@dataListProjects');
Route::get('/data-list-bugs', 'BugController@dataListBugs');                  // id => project id
Route::get('/data-list-bug-comments', 'BugController@dataListBugComments');   // id => bug id
Route::get('/data-list-users', 'UserController@dataListUsers');

Route::get('/logout', 'AuthenticationController@logout');
