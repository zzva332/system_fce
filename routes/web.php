<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
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

Route::get('/', [AuthController::class, 'index'])->name('index');
Route::redirect('login', '/');
Route::post("login", [AuthController::class, 'authenticate'])->name("login");
Route::get("auth/forget_password", [AuthController::class, 'forgetPassword'])->name("forget_password");

Route::middleware(['auth', 'auth.session'])->group(function () {
    Route::get("auth/logout", [AuthController::class, 'logout'])->name("logout");
    Route::get("dashboard", [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class)->except(['show']);
    Route::resource('clients', ClientController::class)->except(['show']);
    Route::resource('products', ProductController::class)->except(['show']);
});