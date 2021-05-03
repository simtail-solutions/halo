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
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('applicants','App\Http\Controllers\ApplicantsController');
Route::resource('applications', 'App\Http\Controllers\ApplicationsController');
Route::get('applications/{application}', 'App\Http\Controllers\ApplicationsController@show');

Route::resource('users','App\Http\Controllers\UsersController');
Route::get('users/profile/{user}', 'App\Http\Controllers\UsersController@show');
//Route::get('users/update/{user}', 'App\Http\Controllers\UsersController@update')->name('users.update-profile');
//Route::get('users/index', [App\Http\Controllers\UsersController::class, 'index'])->name('index');

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/patient', function () {
    return view('patient');
});

Route::get('/practice', function () {
    return view('practice');
});

Route::get('/user-profile', function () {
    return view('user-profile');
});