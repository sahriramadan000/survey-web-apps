<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserSelectionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// ============================================================
// Front Web
// ============================================================
Route::get('/', function () {
    return view('front-view.survey.index');
})->name('home');

Route::post('/user-selections', [UserSelectionController::class, 'store'])->name('user-selections.store');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
