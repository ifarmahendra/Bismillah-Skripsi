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

// Route::get('/', function () {
//     return view('user');
// });
Route::resource('/', App\Http\Controllers\HalamanUtama::class);

Route::resource('/admin/dashboard', App\Http\Controllers\AdminDashboard::class);    
Route::resource('/admin/learningjurnal', App\Http\Controllers\AdminLearningJurnal::class);
Route::resource('/admin/matakuliah', App\Http\Controllers\AdminMataKuliah::class);
Route::resource('/admin/filterjawaban', App\Http\Controllers\AdminFilterJawaban::class);
Route::resource('/admin/jawaban', App\Http\Controllers\AdminJawaban::class);
Route::resource('/forminput', App\Http\Controllers\FormInputController::class);
// Route::get('/filter', 'App\Http\Controllers\AdminJawaban@filter')->name('jawaban.filter');
// Route::get('filter/jawaban', 'App\Http\Controllers\AdminJawaban@filterjawaban');
Route::get('/formjawaban/cetak_pdf', 'App\Http\Controllers\AdminFilterJawaban@cetak_pdf');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user');
