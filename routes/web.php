<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MikrotikController;
use App\Http\Controllers\DashboardController;



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

    Route::resource('server', ServerController::class);

    Route::view('about', 'about')->name('about');

    // Profile routes
    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

    // Dashboard routes
    Route::get('dashboard/{id}', [DashboardController::class, 'show'])->name('dashboard.show');
    Route::get('dashboard/uptime/{id}', [DashboardController::class, 'uptime'])->name('dashboard.uptime');
    Route::get('dashboard/status/{id}', [DashboardController::class, 'status'])->name('dashboard.status');
    Route::get('dashboard/user/income/{id}', [DashboardController::class, 'countUserAndIncome'])->name('dashboard.userIncome');
    Route::get('dashboard/active/income/{id}', [DashboardController::class, 'countActiveUserAndIncome'])->name('dashboard.activeUserIncome');

    // check mikrotik status
    Route::post('dashboard/checkMikrotikStatus', [MikrotikController::class, 'checkMikrotikStatus'])->name('checkMikrotikStatus');

    // Hotspot routes
    Route::get('hotspot/list-user/{id}', [UserController::class, 'showUser'])->name('hotspot.showUser');
    Route::get('hotspot/list-active/{id}', [UserController::class, 'showActive'])->name('hotspot.showActive');
    Route::get('hotspot/user/{id}', [UserController::class, 'listUser'])->name('hotspot.user');
    Route::get('hotspot/active/{id}', [UserController::class, 'listUserActive'])->name('hotspot.active');


    Route::get('test/{id}', [TestController::class, 'index'])->name('user.index');

});
