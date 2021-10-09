<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactFormController;
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
Route::put('applications/update/{applicant}', 'App\Http\Controllers\ApplicationsController@update');

Route::resource('applications/{application}/categories', 'App\Http\Controllers\CategoriesController');
//Route::resource('categories', 'App\Http\Controllers\CategoriesController');

Route::resource('users','App\Http\Controllers\UsersController');
Route::get('users/profile/{user}', 'App\Http\Controllers\UsersController@show');
Route::get('users/profile/{user}/update-profile', 'App\Http\Controllers\UsersController@edit')->name('users.update-profile');
//Route::get('users/update/{user}', 'App\Http\Controllers\UsersController@update')->name('users.update-profile');
//Route::get('users/index', [App\Http\Controllers\UsersController::class, 'index'])->name('index');

//Route::get('contact', 'App\Http\Controllers\ContactController@index');
//Route::post('contact', 'App\Http\Controllers\ContactController@store')->name('contact.store');
Route::get('contact', [ContactFormController::class, 'createForm'])->name('contact.index');
Route::post('contact', [ContactFormController::class, 'ContactForm'])->name('contact.store');

Route::get('/patient', function () {
    return view('patient');
});

Route::get('/practice', function () {
    return view('practice');
});

// Route::get('/user-profile', function () {
//     return view('user-profile');
// });

//Route::get('user/profile', 'App\Http\Controllers\UsersController@edit')->name('users.update-profile');
    //Route::put('user/profile', 'App\Http\Controllers\UsersController@update')->name('users.update-profile');
   // Route::get('users', 'App\Http\Controllers\UsersController@index')->name('users.index');
    //Route::post('users/{user}/make-admin', 'App\Http\Controllers\UsersController@makeAdmin')->name('users.make-admin');

// Route::middleware(['auth', 'admin'])->group(function() {
//     Route::get('user/profile', 'App\Http\Controllers\UsersController@edit')->name('users.edit-profile');
//     //Route::put('user/profile', 'App\Http\Controllers\UsersController@update')->name('users.update-profile');
//     Route::get('users', 'App\Http\Controllers\UsersController@index')->name('users.index');
//     //Route::post('users/{user}/make-admin', 'App\Http\Controllers\UsersController@makeAdmin')->name('users.make-admin');
// });

