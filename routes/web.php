<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeopleController;

Route::get('/', function () {
    return redirect()->route('people');
});

Route::controller(PeopleController::class)->prefix('people')->group(function () {
    Route::get('/', 'index')->name('people');
    Route::get('create', 'create')->name('people.create');
    Route::post('store', 'store')->name('people.store');
});
