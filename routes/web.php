<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskUserController;
use App\Http\Controllers\UserController;
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

// Route::get('/', function () {
//     return view('content.dashboard');
// })->name('dashboard');

// Route::get('/dashboard', function () {
//     return view('content.dashboard');
// })->name('dashboard');


Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 
Route::get('dashboard', [AuthController::class, 'dashboard']); 
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

/************************ User Management *************************/
Route::controller(UserController::class)->prefix('users')->name('users.')->group(function () {
    Route::get('index', 'index')->name('index');
    Route::get('deleted', 'index')->name('deleted');

    Route::post('store', 'store')->name('store');
    Route::post('edit', 'edit')->name('edit');
    Route::post('update', 'update')->name('update');
    Route::post('delete', 'delete')->name('delete');
    Route::post('restore', 'restore')->name('restore');
});
/************************ User Management *************************/

/************************ Task Management *************************/
Route::controller(TaskController::class)->prefix('tasks')->name('tasks.')->group(function () {
    Route::get('index', 'index')->name('index');
    Route::get('deleted', 'index')->name('deleted');

    Route::post('store', 'store')->name('store');
    Route::post('edit', 'edit')->name('edit');
    Route::post('update', 'update')->name('update');
    Route::post('delete', 'delete')->name('delete');
    Route::post('restore', 'restore')->name('restore');

    Route::controller(TaskUserController::class)->prefix('assign')->name('assign.')->group(function () {
        Route::get('index/{taskId?}', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::post('edit', 'edit')->name('edit');
        Route::post('update-status', 'update_status')->name('update-status');

        Route::get('view-tasks/{taskId}', 'view_assigned_tasks')->name('view-tasks')->middleware('signed');

        Route::get('my-tasks', 'index')->name('my-tasks');
        Route::get('to-do', 'index')->name('to-do');
        Route::get('in-progress', 'index')->name('in-progress');
        Route::get('ready-for-qa', 'index')->name('ready-for-qa');
        Route::get('ready-for-production', 'index')->name('ready-for-production');
    });        

});
/************************ Task Management *************************/
