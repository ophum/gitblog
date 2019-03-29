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

Route::get('/', function () {
    return view('welcome');
});


Route::namespace('User')->group(function () {

    Route::get('register', AuthController::class.'@showRegisterForm')->name('showRegister');
    Route::post('register', AuthController::class.'@register')->name('register');

    Route::get('login', AuthController::class.'@showLoginForm')->name('showLogin');
    Route::post('login', AuthController::class.'@login')->name('login');

    Route::middleware(['auth:web'])->group(function () {

        Route::get('logout', AuthController::class.'@logout')->name('logout');

        Route::get('/home', 'HomeController@index')->name('home');

        Route::resource('/repository', 'RepositoryController');

    });

});
