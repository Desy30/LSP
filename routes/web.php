<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticationController::class, 'loginPage'])->name('login');
    Route::post('login', [AuthenticationController::class, 'login'])->name('login.process');
});
Route::middleware('auth')->group(function () {
    Route::get(uri: 'logout', action: [AuthenticationController::class, 'logout'])->name('logout');

    Route::prefix('news')->group(function () {

        Route::get('', [NewsController::class, 'index'])->name('news');

        Route::get('create', action: [NewsController::class, 'create'])->name('news.create')->middleware('can:create news');

        Route::post('store', action: [NewsController::class, 'store'])->name('news.store');

        Route::get('{id}/edit', [NewsController::class, 'edit'])->name('news.edit');

        Route::put('{id}/update', [NewsController::class, 'update'])->name('news.update');

        Route::delete('{id}/destroy', [NewsController::class, 'destroy'])->name('news.destroy');
    });
});
