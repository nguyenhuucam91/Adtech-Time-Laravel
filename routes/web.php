<?php

use App\Http\Controllers\AuthorizeController;
use App\Http\Controllers\CreateLogController;
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

Route::get('/logs/{cardId}', [LogController::class, 'show'])->name('log.show');

Route::get('authorize', [AuthorizeController::class, 'index'])->name('authorize.index');
Route::get('/authorize-success', [AuthorizeController::class, 'success'])->name('authorize.success');
