<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{IndexController};
use App\Http\Controllers\Auth\LoginController;
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

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/register', [LoginController::class, 'register'])->name('register');
Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');

Route::middleware(['auth'])->prefix('dashboard')->name('user.')->group(function () {
    Route::get('/',[IndexController::class,'index'])->name('dashboard');
    Route::get('/logout',[LoginController::class,'logout'])->name('logout');
});

Route::get('/backend/{any?}', function () {
    return view('backend');
})->where('any', '.*');