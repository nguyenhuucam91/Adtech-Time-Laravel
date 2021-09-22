<?php

use Adtech\AdtechTimeTracker\Http\Controllers\LogController;

Route::prefix('/adtech-time-tracker')->name('adtech-time-tracker.')->group(function () {
    Route::get('/', function () {
        return view('adtech-time-tracker::welcome');
    });

    Route::get('/logs/create', [LogController::class, 'create'])->name('log.create');
    Route::post('/logs', [LogController::class, 'store'])->name('log.store');
    Route::get('/logs/{cardId}', [LogController::class, 'index'])->name('log.index');
    Route::delete('/logs/{id}', [LogController::class, 'destroy'])->name('log.destroy');
    Route::get('/logs/{id}/edit', [LogController::class, 'edit'])->name('log.edit');
    Route::put('/logs/{id}', [LogController::class, 'update'])->name('log.update');


    Route::get('authorize', [AuthorizeController::class, 'index'])->name('authorize.index');
    Route::get('/authorize-success', [AuthorizeController::class, 'success'])->name('authorize.success');

});
