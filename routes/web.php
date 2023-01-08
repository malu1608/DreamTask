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
// Home
Route::get('/', function() {
    return view('pages.home');
});
Route::get('/home', function() {
    return view('pages.home');
});
Route::get('/aboutus', function() {
    return view('pages.aboutus');
});
Route::get('/contactus', function() {
    return view('pages.contactus');
});
Route::get('/faq', function() {
    return view('pages.faq');
});
Route::get('/homeauthenticated', function() {
    return view('pages.homeauthenticated');
});
Route::get('/newproject', function() {
    return view('pages.newproject');
});
// Cards


Route::get('tasks', 'TaskController@showTasks');
Route::get('cards/{id}', 'TaskController@show');

// API
Route::put('api/cards', 'TaskController@create');
Route::delete('api/cards/{card_id}', 'TaskController@delete');
Route::put('api/cards/{card_id}/', 'ItemController@create');
Route::post('api/item/{id}', 'ItemController@update');
Route::delete('api/item/{id}', 'ItemController@delete');

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Search Bar
Route::get('live_search', 'LiveSearch@index');
Route::get('live_search/action', 'LiveSearch@action') -> name('live_search.action');
Route::get('live_search/action_proj', 'LiveSearch@action_proj') -> name('live_search.action_proj');
Route::get('live_search/action_task', 'LiveSearch@action_task') -> name('live_search.action_task');

// User information
Route::get('profile', [ProfileController::class, 'index'])->name('profile');
Route::post('profile/edit_validation', [ProfileController::class, 'edit_validation'])->name('profile.edit_validation');

Route::get('/profile/{id_user}', [UserController::class,'showUserProfile']);
Route::get('/profile/{id_user}/view', [UserController::class,'showViewUserProfile']);
Route::post('/profile/{id_user}/updateUser', [UserController::class,'updateUserById']);
Route::post('/profile/{id_user}/deleteProfile', [UserController::class,'deleteUserProfile']);


//working
Route::get('/homeauthenticated', 'ProjectsController@showAllProjects');
//Route::get('projects/team/{id}', 'ProjectsController@showProjectsLists')->where('id', '[0-9]+');
Route::get('project/{id}', 'ProjectsController@show')->where('id', '[0-9]+');
Route::post('project/{id}', 'TeamMemberController@removeMember');
Route::post('project/{id}/info', 'ProjectsController@update');
Route::post('project/{id}/create_team', 'TeamMemberController@create')->where('id', '[0-9]+');
Route::post('project/{id}/delete_team', 'TeamMemberController@delete')->where('id', '[0-9]+');
Route::post('project/{id}/add_member', 'TeamMemberController@addMember')->where('id', '[0-9]+');

Route::get('project/team/{id}/tasks', 'TaskController@showTasks')->where('id', '[0-9]+');
//Route::post('project/team/{id}/tasks/deltask', 'TaskController@deleteTask');
Route::get('/admin/users', 'UserController@showAdminUsers')->name('showAdminUsers');
Route::get('editProfile','ProfileController@showEdit')->name('editProfile');
Route::post('editProfile', 'ProfileController@editProfile');
Route::get('user/{id}', 'UserController@show');


