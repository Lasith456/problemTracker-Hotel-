<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProblemTypeController;
use App\Http\Controllers\ProblemAreaController;
use App\Http\Controllers\NotificationSourceController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ProblemTicketController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider within a group
| which contains the "web" middleware group.
|
*/

// 🏠 Default Home Route
Route::get('/', [HomeController::class, 'index'])->name('home');

// 🔐 Authentication Routes (Login, Register, Forgot Password, etc.)
Auth::routes();

// 🔒 Protected Routes (Require Login)
Route::middleware(['auth'])->group(function () {

    // 🧭 Dashboard / Home
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // 👥 User & Role Management
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

    // 🛒 Product Management
    Route::resource('products', ProductController::class);
    Route::resource('problem-types', ProblemTypeController::class);
    Route::resource('problem-areas', ProblemAreaController::class);
    Route::resource('notification-sources', NotificationSourceController::class);
    Route::resource('hotels', HotelController::class);
    Route::resource('tickets', ProblemTicketController::class);


});
