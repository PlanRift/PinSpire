<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PinController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/pinspire', [PinController::class, 'index']);
Route::get('/pinspire/{id}', [PinController::class, 'show']);
Route::post('/pinspire/create', [PinController::class, 'create']);
Route::patch('/pinspire/{id}', [PinController::class, 'edit']);
Route::delete('/pinspire/delete/{id}', [PinController::class, 'delete']);

Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/profile', [AuthController::class, 'profile']);

Route::post('/like/{id}', [LikeController::class, 'like']);
Route::delete('/unlike/{id}', [LikeController::class, 'unlike']);

Route::post('/comment', [CommentsController::class, 'comment']);
Route::patch('/comment/{id}', [CommentsController::class, 'edit']);
Route::delete('/comment/{id}', [CommentsController::class, 'delete']);