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
Route::get('auto-complete-address', [AutoAddressController::class, 'googleAutoAddress']);
Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::group(['middleware' => 'prevent-back-history'],function(){\
	Auth::routes();
	Route::get('/home', 'HomeController@index');
});

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


Route::resource('applicants','App\Http\Controllers\ApplicantsController');
Route::resource('applications', 'App\Http\Controllers\ApplicationsController');
Route::get('archived-applications', 'App\Http\Controllers\ApplicationsController@trashed')->name('archived-applications.index');
Route::get('applications/{application}/restore', 'App\Http\Controllers\ApplicationsController@restore')->name('applications.restore');
Route::get('applications/{application}', 'App\Http\Controllers\ApplicationsController@show')->name('application.show');
Route::put('applications/{application}/update', 'App\Http\Controllers\ApplicationsController@update');
Route::resource('emails','App\Http\Controllers\EmailsController');
//Route::get('applications/{application}', 'App\Http\Controllers\ApplicationsController@resendEmail')->name('application.resendEmail');
Route::resource('brochures','App\Http\Controllers\BrochureController');

Route::put('applications/{application}/updates', 'App\Http\Controllers\UpdatesController@store')->name('updates.store');

Route::middleware(['auth'])->group(function () { 
    Route::get('/applicants/send', function () {
        return view('send');
    });


    Route::resource('users','App\Http\Controllers\UsersController');
    Route::get('users/profile/{user}', 'App\Http\Controllers\UsersController@show')->name('users.show');
    Route::get('users/profile/{user}/edit', 'App\Http\Controllers\UsersController@edit')->name('users.edit');    
    Route::put('users/profile/{user}/update', 'App\Http\Controllers\UsersController@update')->name('users.update');
    Route::put('users/profile/{user}', 'App\Http\Controllers\UsersController@activate')->name('users.activate');
    Route::post('users/{user}/make-admin', 'App\Http\Controllers\UsersController@makeAdmin')->name('users.make-admin');
    Route::post('users/{user}/remove-admin', 'App\Http\Controllers\UsersController@removeAdmin')->name('users.remove-admin');

    Route::get('/user-profile', function () {
        return view('user-profile');
    });

    

    // Route::resource('updatepassword','App\Http\Controllers\UpdatePasswordController');
    // Route::get('updatepassword/{user}/edit', 'App\Http\Controllers\UpdatePasswordController@edit')->name('updatepassword.edit');

});

