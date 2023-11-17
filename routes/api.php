<?php

use App\Http\Controllers\Api\CarouselItemsController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\API\UserControl;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login')->name('user.login');
    Route::post('/logout', 'logout');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(CarouselItemsController::class)->group(function () {

    Route::get('/carousel', 'index');
    Route::get('/carousel/{id}', 'show');
    Route::post('/carousel', 'store');
    Route::put('/carousel/{id}', 'update');
    Route::delete('/carousel/{id}', 'destroy');

});

// Route::get('/user', [UserController::class, 'index']);
// Route::get('/user/{id}', [UserController::class, 'show']);
// Route::put('/user/{id}', [UserController::class, 'update'])->name('users.update');
// Route::post('/user', [UserController::class, 'store'])->name('users.store');
// Route::put('/user/email/{id}', [UserController::class, 'email'])->name('user.email');
// Route::delete('/user/{id}', [UserController::class, 'destroy']);


// Route::get('/message', [MessageController::class, 'index']);
// Route::get('/message/{id}', [MessageController::class, 'show']);
// Route::delete('/message/{id}', [MessageController::class, 'destroy']);
// Route::post('/message', [MessageController::class, 'store']);
// Route::put('/message/{id}', [MessageController::class, 'update']);

