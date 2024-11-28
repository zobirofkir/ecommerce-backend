<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
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
 * Category Routes
 */
Route::apiResource('/categories', CategoryController::class);

/**
 * Product Routes
 */
Route::get('/products', [ProductController::class, 'index']);

Route::get('/products/{slug}', [ProductController::class, 'show']);

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
