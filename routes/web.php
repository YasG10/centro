<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CentroController;

Route::get('/', function () {
    return view('auth.login');
});

/*
Route::get('/centro', function () {
    return view('centros.index');
});

Route::get('/centro/create', [CentroController::class, 'create']);
*/

Route::resource('centros', CentroController::class)->middleware('auth');
Auth::routes(['reset' => false]);

Route::get('/home', [CentroController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [CentroController::class, 'index'])->name('home');
});