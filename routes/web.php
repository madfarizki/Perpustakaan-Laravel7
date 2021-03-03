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

// Login Security
Route::get('/', function () {
    return view('auth.login');
});

// Admin
Route::prefix('admin')
    ->middleware(['auth', 'role'])
    ->group(function() {
    // Dashboard
    Route::get('/', 'AdminController@index' )->name('dashboard');

    // Buku
    Route::resource('buku', 'BookController' );
    Route::get('/search', 'BookController@search');

    // Peminjaman
    Route::resource('peminjaman', 'BorrowingController' );
    Route::get('/peminjaman/search', 'BorrowingController@loadData');
    Route::get('/search/peminjaman', 'BorrowingController@search');
    Route::get('/find-barcode', 'BorrowingController@barcode')->name('find.barcode');
    // Route::get('/peminjaman/create/search', 'BorrowingController@action')->name('live_search.action');

    // Siswa
    Route::resource('siswa', 'StudentController' );
    Route::get('/search/siswa', 'StudentController@search');

    // Laporan
    // Route::get('/laporan', 'ReportController@borrowingReport' )->name('admin.laporan');
    Route::get('/laporan/search', 'ReportController@borrowingReportSearch' )->name('admin.laporan.search');
    Route::get('/laporan/generate', 'ReportController@generateReportPdf' )->name('laporan.generate.pdf');
    
    Route::get('/laporan', 'ReportController@orderReport')->name('report.order');
    Route::get('/laporan/pdf/{daterange}', 'ReportController@orderReportPdf')->name('report.order_pdf');


    // Denda
    Route::get('/denda', 'BorrowingController@denda')->name('denda');

    // Petugas
    Route::resource('petugas', 'OfficerController');
    Route::get('/search/petugas', 'OfficerController@search');

});


Route::get('/home', 'HomeController@index')->name('home');

Auth::routes(['register' => false]);