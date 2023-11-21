<?php

use App\Http\Controllers\Api\CarouselItemsController;
use App\Http\Controllers\Api\MessageController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\API\ProfileController;

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
// public API's
Route::controller(AuthController::class)->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('user.login');
    Route::post('/user', [UserController::class, 'store'])->name('users.store');


});

//MESSAGE APIS  

Route::controller(MessageController::class)->group(function () {
    Route::get('/message', [MessageController::class, 'index']);
    Route::get('/message/{id}', [MessageController::class, 'show']);
    Route::delete('/message/{id}', [MessageController::class, 'destroy']);
    Route::post('/message', [MessageController::class, 'store']);
    Route::put('/message/{id}', [MessageController::class, 'update']);


});

//user selection
Route::get('/user/selection', [UserController::class, 'selection']);


// private API's
Route::middleware(['auth:sanctum',])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    //admin API's
    Route::controller(CarouselItemsController::class)->group(function () {

        Route::get('/carousel', 'index');
        Route::get('/carousel/{id}', 'show');
        Route::post('/carousel', 'store');
        Route::put('/carousel/{id}', 'update');
        Route::delete('/carousel/{id}', 'destroy');


    });
    Route::controller(UserController::class)->group(function () {

        // UserController routes
        Route::get('/user', [UserController::class, 'index']);
        Route::get('/user/{id}', [UserController::class, 'show']);
        Route::put('/user/{id}', [UserController::class, 'update'])->name('users.update');
        Route::put('/user/email/{id}', [UserController::class, 'email'])->name('user.email');
        Route::put('/user/image/{id}', [UserController::class, 'image'])->name('user.image');
        Route::delete('/user/{id}', [UserController::class, 'destroy']);


    });

    //user specific API's
    Route::get('/profile/show', [ProfileController::class, 'show']);

    Route::put('/profile/image', [ProfileController::class, 'image'])->name('profile.image');




});




