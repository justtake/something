<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect()->route(Auth::check() ? 'people' : 'auth');
})->name('home');

Route::controller(PeopleController::class)->prefix('people')->middleware('logged_in')->group(function () {
    Route::get('/', 'index')->name('people');
    Route::get('create', 'create')->name('people.create');
    Route::post('store', 'store')->name('people.store');
});

Route::controller(AuthController::class)->prefix('auth')->group(function () {
    Route::get('/', 'index')->name('auth')->middleware('guest');
    Route::post('login', 'login')->name('auth.login');
    Route::post('logout', 'logout')->name('auth.logout');
});
