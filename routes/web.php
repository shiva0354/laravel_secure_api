<?php

use App\Http\Controllers\EmailController;
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
    return view('welcome');
});
Route::view('login', 'login')->name('login');
Route::view('register', 'register')->name('register');
Route::view('books', 'books');

Route::prefix('email')->group(function () {
    Route::get('/', [EmailController::class, 'index'])->name('email.index');
    Route::post('/email', [EmailController::class, 'store'])->name('email.store');
});
