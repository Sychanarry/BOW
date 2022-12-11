<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ListtodoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkingController;
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

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // view my project have to asign work
    Route::get('working/index', [WorkingController::class, 'index'])->name('working.index');

    // view my todo by project
    Route::get('working/view/{id}', [WorkingController::class, 'view'])->name('working.view');

    // view project by user id
    Route::get('project/viewprojectbyuser/{projectid}/{asignid}', [ProjectController::class, 'viewprojectbyuser'])->name('project.viewprojectbyuser');
    // get list todo by project id
    Route::get('listtodobyproject/{id}', [ListtodoController::class, 'listtodobyproject'])->name('listtodobyproject');
    // function update todo detail
    Route::post('updatetododetail', [ListtodoController::class, 'updatetododetail'])->name('listtodo.updatetododetail');
});
