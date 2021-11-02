<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\AutoAddressController;
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
Route::get('applications/{application}/edit', 'App\Http\Controllers\ApplicationsController@edit')->name('application.edit');
Route::get('contact', [ContactFormController::class, 'createForm'])->name('contact.index');
Route::post('contact', [ContactFormController::class, 'ContactForm'])->name('contact.store');

Route::get('/patient', function () {
    return view('patient');
});

Route::get('/practice', function () {
    return view('practice');
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () { 

    Route::resource('applicants','App\Http\Controllers\ApplicantsController');
    Route::resource('applications', 'App\Http\Controllers\ApplicationsController');
    Route::get('applications/{application}', 'App\Http\Controllers\ApplicationsController@show')->name('application.show');
    Route::put('applications/{application}/update', 'App\Http\Controllers\ApplicationsController@update');

    Route::get('auto-complete-address', [AutoAddressController::class, 'googleAutoAddress']);

    Route::put('applications/{application}/updates', 'App\Http\Controllers\UpdatesController@store')->name('updates.store');
    Route::resource('users','App\Http\Controllers\UsersController');
    Route::get('users/profile/{user}', 'App\Http\Controllers\UsersController@show');
    Route::get('users/profile/{user}/edit', 'App\Http\Controllers\UsersController@edit')->name('users.edit');
    Route::put('users/profile/{user}/update', 'App\Http\Controllers\UsersController@update')->name('users.update');

    Route::get('/user-profile', function () {
        return view('user-profile');
    });

    Route::resource('updatepassword','App\Http\Controllers\UpdatePasswordController');
    Route::get('updatepassword/{user}/edit', 'App\Http\Controllers\UpdatePasswordController@edit')->name('updatepassword.edit');

});

