<?php

use App\Http\Controllers\PinController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/pinspire', [PinController::class, 'index']);
Route::post('/pinspire/create', [PinController::class, 'create']);
Route::patch('/pinspire/{id}', [PinController::class, 'edit']);
Route::delete('/pinspire/delete/{id}', [PinController::class, 'delete']);