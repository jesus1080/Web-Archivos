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
#Archivos
Route::get('/files', [App\Http\Controllers\User\ArchivoController::class, 'index'])->name('user.files.index');
Route::get('/files/{file}', [App\Http\Controllers\User\ArchivoController::class, 'show'])->name('user.files.show');
Route::post('/upload', [App\Http\Controllers\User\ArchivoController::class, 'store'])->name('user.files.store');
Route::delete('/delete-files/{file}', [App\Http\Controllers\User\ArchivoController::class, 'destroy'])->name('user.files.destroy');