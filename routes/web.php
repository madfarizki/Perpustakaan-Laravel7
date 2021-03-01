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
    ->middleware(['auth', 'role'])
    ->group(function() {

    Route::get('/', 'AdminController@index' )->name('dashboard');

    Route::resource('buku', 'BookController' );
    Route::resource('peminjaman', 'BorrowingController' );
    Route::resource('siswa', 'StudentController' );
    Route::resource('laporan', 'StudentController' );
    
    Route::get('/search', 'BookController@search');

    Route::get('/peminjaman/search', 'BorrowingController@loadData');
    Route::get('/search/peminjaman', 'BorrowingController@search');
    Route::get('/peminjaman/create/search', 'BorrowingController@action')->name('live_search.action');


    Route::get('/find-barcode', 'BorrowingController@barcode')->name('find.barcode');

});


Route::get('/home', 'HomeController@index')->name('home');

Auth::routes(['register' => false]);