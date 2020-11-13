<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'registerUser'])->name('user.register');
Route::post('/login', [AuthController::class, 'loginUser'])->name('user.login');

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/books', [BookController::class, 'index'])->name('book.show');
    Route::post('/books', [BookController::class, 'store'])->name('book.add');
    Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('book.delete');
    Route::put('/books/{id}', [BookController::class, 'update'])->name('book.update');
    Route::get('/books/{id}', [BookController::class, 'show'])->name('book.detail');

});
