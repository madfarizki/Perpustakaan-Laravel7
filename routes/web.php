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

// login security
Route::get('/', function () {
    return view('auth.login');
});

// Admin
Route::prefix('admin')
    ->name('admin')
    ->middleware(['auth', 'role'])
    ->group(function() {

    Route::get('/', 'AdminController@index' )->name('dashboard');
});


Route::get('/home', 'HomeController@index')->name('home');

Auth::routes(['register' => false]);