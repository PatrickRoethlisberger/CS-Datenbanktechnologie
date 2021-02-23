<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PlanController;
use App\Models\Plan;
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
    return view('home');
})->name('home');

Route::get('/plans', [PlanController::class, 'index'])->name('plans');

// Authenticated and verified routes
Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/orders', OrderController::class)->only(['index','store']);
    Route::get('/orders/create/{plan}', [OrderController::class, 'create'])->name('orders.create');
    Route::resource('/locations', LocationController::class)->only(['index','store','create']);
});

require __DIR__.'/auth.php';
