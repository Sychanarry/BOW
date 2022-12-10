<?php

use App\Http\Controllers\ListtodoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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



Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('auth', [LoginController::class, 'auth'])->name('auth');

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::resource('user', UserController::class);
    Route::resource('project', ProjectController::class);
    Route::resource('todo', TodoController::class);
    Route::resource('listtodo', ListtodoController::class);
    //get list todo by project id
    Route::get('listtodobyproject/{id}', [ListtodoController::class, 'listtodobyproject'])->name('listtodobyproject');
});
