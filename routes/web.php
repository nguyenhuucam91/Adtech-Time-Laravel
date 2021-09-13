<?php

use App\Http\Controllers\AuthorizeController;
use App\Http\Controllers\CreateLogController;
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
    return view('welcome')->with(env('TRELLO_API_KEY'));
});

Route::get('/create-log', [CreateLogController::class, 'showCreateLogView'])->name('createlog.showCreateLogView');

Route::get('authorize', [AuthorizeController::class, 'index'])->name('authorize.index');
