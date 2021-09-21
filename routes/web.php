<?php

use App\Http\Controllers\AuthorizeController;
use App\Http\Controllers\LogController;
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

Route::get('/logs/create', [LogController::class, 'create'])->name('log.create');
Route::post('/logs', [LogController::class, 'store'])->name('log.store');
Route::get('/logs/{cardId}', [LogController::class, 'index'])->name('log.index');
Route::delete('/logs/{id}', [LogController::class, 'destroy'])->name('log.destroy');
Route::get('/logs/{id}/edit', [LogController::class, 'edit'])->name('log.edit');
Route::put('/logs/{id}', [LogController::class, 'update'])->name('log.update');


Route::get('authorize', [AuthorizeController::class, 'index'])->name('authorize.index');
Route::get('/authorize-success', [AuthorizeController::class, 'success'])->name('authorize.success');
