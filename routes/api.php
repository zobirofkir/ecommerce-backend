<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * Register Route
 */
Route::post('auth/register', [AuthController::class, 'register']);

/**
 * Login Route
 */
Route::post('auth/login', [AuthController::class, 'login']);

/**
 * Forgot Password Route
 */
Route::post('auth/forgot', [AuthController::class, 'forgotPassword']);

/**
 * Authenticated Routes
 */
Route::middleware('auth:api')->group(function () {

    /**
     * Refresh Route
     */
    Route::get('auth/refresh', [AuthController::class, 'refresh']);

    /**
     * Me Route
     */
    Route::get('auth/me', [AuthController::class, 'me']);

    /**
     * Logout Route
     */
    Route::post('auth/logout', [AuthController::class, 'logout']);
});
