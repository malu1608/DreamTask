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
// Cards
Route::get('cards', 'CardController@list');
Route::get('cards/{id}', 'CardController@show');

// API
Route::put('api/cards', 'CardController@create');
Route::delete('api/cards/{card_id}', 'CardController@delete');
Route::put('api/cards/{card_id}/', 'ItemController@create');
Route::post('api/item/{id}', 'ItemController@update');
Route::delete('api/item/{id}', 'ItemController@delete');

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

//Admin
Route::get('/admin/users', 'AdminController@showUsers')->name('show-admin-users');
Route::get('/admin/users/{id}/remove', 'AdminController@removeUser');
Route::get('/admin/users/{id}/edit', 'AdminController@editUser');
Route::get('admin/profile/{id}', [AdminController::class,'showAdminProfile']);

// Search Bar
Route::get('live_search', 'LiveSearch@index');
Route::get('live_search/action', 'LiveSearch@action') -> name('live_search.action');
Route::get('live_search/action_proj', 'LiveSearch@action_proj') -> name('live_search.action_proj');
Route::get('live_search/action_task', 'LiveSearch@action_task') -> name('live_search.action_task');

// User information
Route::get('profile', [ProfileController::class, 'index'])->name('profile');
Route::post('profile/edit_validation', [ProfileController::class, 'edit_validation'])->name('profile.edit_validation');


// Projects
Route::get('projects', 'ProjectsController@showProjects');
Route::get('create_project', 'ProjectsController@projectForm');
Route::post('create_project', 'ProjectsController@createProject');

Route::get('project/{id}/tasks', [TasksController::class,'showTasks']);
Route::get('project/{id}/forum', [ProjectForumController::class,'show']);
Route::post('project/{id}/forum/send', [ProjectForumController::class,'sendMessage']);

//Task
Route::get('project/{id}/tasksCreate', [TasksController::class,'showTaskForm']);
Route::post('tasksCreate', [TasksController::class,'create']);
Route::get('/project/{id}/task/{task_id}', [TasksController::class,'showTask']);
Route::post('/project/{id}/task/{task_id}/update', [TasksController::class,'updateTask']);

//Notification
Route::post('notification/{id}/manager', [NotificationsController::class,'managerNotification']);
Route::post('notification/{id}/taskClosed', [NotificationsController::class,'taskClosedNotification']);
Route::post('notification/{id}/assign', [NotificationsController::class,'assignNotification']);
Route::post('notifications/{id}/clear', [NotificationsController::class,'clearNotifications']);