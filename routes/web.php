<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ReportController;


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

Route::get('/test', [App\Http\Controllers\TestController::class, 'index'])->name('test');


Route::get('/welcome', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    
    Route::get('dashboard/{id}', [DashboardController::class, 'show'])->name('dashboard.show');
    //Route::get('dashboard/{id}/uptime', [DashboardController::class, 'uptime'])->name('dashboard.uptime');
    Route::get('dashboard/uptime/{id}', [DashboardController::class, 'uptime'])->name('dashboard.uptime');
    Route::get('dashboard/user/{id}', [UserController::class, 'user'])->name('user.user');
    Route::get('dashboard/active/user/{id}', [UserController::class, 'activeUser'])->name('user.activeUser');



    Route::resource('client', ClientController::class);
    Route::resource('setting', SettingController::class);
    Route::resource('report', ReportController::class);
    // Route::get('client', [\App\Http\Controllers\ClientController::class, 'index'])->name('client-index');
    // Route::POST('client/store', [\App\Http\Controllers\ClientController::class, 'store'])->name('client-store');
});
