<?php

use App\Http\Controllers\Auth\LoginRegisterEditController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TimelineEventController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(Controller::class)->group(function () {
    Route::get('/', 'dashboard')->name('dashboard');
    Route::get('/profile', 'profile')->name('profile')->middleware('auth');
    Route::get('/settings', 'settings')->name('settings')->middleware('auth');
    Route::get('/table/users', 'users')->name('users')->middleware('auth');
    Route::get('/table/categories', 'categories')->name('categories')->middleware('auth');
    Route::get('/table/timelineEvents', 'timelineEvents')->name('timelineEvents')->middleware('auth');
    Route::get('/table/timelineEventCategories', 'timelineEventCategories')->name('timelineEventCategories')->middleware('auth');
    Route::get('/table/userSettings', 'userSettings')->name('userSettings')->middleware('auth');
});

Route::controller(LoginRegisterEditController::class)->group(function () {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::post('/logout', 'logout')->name('logout')->middleware('auth');
    Route::get('/change', 'change')->name('change');
    Route::post('/change', 'changePassword')->name('changePassword');
    Route::post('/editProfile', 'editProfile')->name('editProfile')->middleware('auth');
    Route::post('/upload', 'uploadAvatar')->name('uploadAvatar')->middleware('auth');
    Route::post('/editSettings', 'editSettings')->name('editSettings')->middleware('auth');
});

Route::controller(TimelineEventController::class)->group(function () {
    Route::get('/timeline/list', 'eventList')->name('timelineList');
    Route::get('/timeline/upcomingList', 'upcomingEventList')->name('upcomingEventList');
    Route::get('/timeline/{id}/get', 'getEventDetails')->name('getEventDetails');
    Route::get('/category/{id}/get', 'getCategoryDetails')->name('getCategoryDetails');
    Route::post('/timeline/{id}/upload', 'uploadPoster')->name('uploadPoster')->middleware('auth');
    Route::get('/timeline/add', 'addEventView')->name('addEventView')->middleware('auth');
    Route::post('/timeline/add', 'addEvent')->name('addEvent')->middleware('auth');
    Route::post('/timeline/{id}/delete', 'deleteEvent')->name('deleteEvent')->middleware('auth');
    Route::post('/timeline/{id}/edit', 'editEvent')->name('editEvent')->middleware('auth');
    Route::get('/category/add', 'addCategoryView')->name('addCategoryView')->middleware('auth');
    Route::post('/category/add', 'addCategory')->name('addCategory')->middleware('auth');
    Route::post('/category/{id}/delete', 'deleteCategory')->name('deleteCategory')->middleware('auth');
    Route::post('/category/{id}/edit', 'editCategory')->name('editCategory')->middleware('auth');
    Route::post('/timeline/filter/set', 'setFilters')->name('setFilters');
    Route::post('/timeline/filter/clear', 'clearFilters')->name('clearFilters');
});

Route::controller(CategoryController::class)->group(function () {
    Route::get('/category/list', 'categoryList')->name('categoryList');
});
