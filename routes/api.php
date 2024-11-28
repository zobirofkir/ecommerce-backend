<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
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

/**
 * Get Product By Slug
 */
Route::get('/products/{slug}', [ProductController::class, 'show']);

/**
 * Get Products By Category Slug
 */
Route::get('categories/{slug}/products', [ProductController::class, 'categoryProducts']);

/**
 * Authenticated Routes
 */
Route::middleware('auth:api')->group(function () {

    /**
     * Add To Cart Route
     */
    Route::post('carts/{productId}', [CartController::class, 'addToCart']);

    /**
     * Get Product From Card
     */
    Route::get('carts', [CartController::class, 'getCartItems']);

    /**
     * Delect Product From Card
     */
    Route::delete('carts/{cartId}', [CartController::class, 'removeFromCart']);

    /**
     * Update Product From Card
     */
    Route::put('carts/{productId}', [CartController::class, 'updateCartQuantity']);

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
