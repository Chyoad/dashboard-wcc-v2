<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AboutController;



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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    Route::get('users', [UserController::class, 'index'])->name('users.index');

    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('dashboard/{id}', [DashboardController::class, 'show'])->name('dashboard.show');
    Route::get('dashboard/uptime/{id}', [DashboardController::class, 'uptime'])->name('dashboard.uptime');
    Route::get('dashboard/status/{id}', [DashboardController::class, 'status'])->name('dashboard.status');
    Route::get('dashboard/income/{id}', [DashboardController::class, 'income'])->name('dashboard.income');

    Route::get('dashboard/user/{id}', [UserController::class, 'user'])->name('user.user');
    Route::get('dashboard/active/user/{id}', [UserController::class, 'activeUser'])->name('user.activeUser');

    // Route::get('test/{id}', [TestController::class, 'index'])->name('user.index');

    Route::resource('client', ClientController::class);
    Route::resource('about', AboutController::class);
});