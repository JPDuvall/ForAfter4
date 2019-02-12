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

/*Route::domain('dashboard.fa4.local')->group(function(){
    Route::get('/', 'DashboardController@index');
    Route::get('/login', 'DashboardController@login');
});*/

/* Dashboard routes */
Route::get('/dashboard', 'DashboardController@index')->name('dashboard-home')->middleware('auth');
Route::get('/dashboard/login', 'DashboardController@login');
Route::get('/dashboard/users', 'DashboardController@users')->name('dashboard-users')->middleware('auth');
Route::get('/dashboard/givers', 'DashboardController@givers')->name('dashboard-givers')->middleware('auth');
// Route::get('/dashboard/categories', 'DashboardController@categories');
// Route::post('/dashboard/categories/save', 'DashboardController@save_category');

/* Pages Routes */
Route::get('/', 'PagesController@landing');
Route::post('/subscribe', 'PagesController@subscribe');
Route::get('/home', 'PagesController@index')->name('home');
Route::get('/email', 'PagesController@test_email');
Route::get('/send', 'PagesController@send_test');
Route::get('/view', 'PagesController@view_email');

Route::get('/about', 'PagesController@about');
Route::get('/explore', 'PagesController@explore');
Route::post('/explore_list', 'PagesController@explorelist');
Route::post('/calculate-booking', 'PagesController@calculate_booking');
Route::post('/book', 'PagesController@book');
Route::post('/contact', 'PagesController@contact');
Route::post('/watch-list/add', 'PagesController@addToList');

Auth::routes();

Route::post('/check_login', 'UserController@check_login');
Route::post('/register', 'UserController@register');
Route::get('/verify/{uuid}', 'UserController@verify');

//Route::get('/home', 'HomeController@index');

Route::post('/authenticate', 'UserController@login');
Route::get('/logout', 'UserController@logout');
Route::get('/hub', 'UserController@dashboard')->name('account-settings')->middleware('auth');
Route::get('/hub/edit-profile', 'UserController@profile')->name('edit-profile')->middleware('auth');
Route::post('/hub/save-profile', 'UserController@update_profile')->middleware('auth');
Route::get('/hub/my-listings', 'UserController@listings')->name('my-listings')->middleware('auth');
Route::get('/hub/my-children', 'UserController@children')->name('my-children')->middleware('auth');
Route::post('/hub/save-child', 'UserController@save_child')->name('save-child')->middleware('auth');
Route::get('/hub/watch-list', 'UserController@watch_list')->name('watch-list')->middleware('auth');
Route::post('/hub/watch-list/table', 'UserController@watchlist_table');
Route::get('/verified', 'UserController@accountverified');

Route::resource('/activities', 'ActivitiesController');