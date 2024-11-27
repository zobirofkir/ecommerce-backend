<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/**
 * Get Reset Password Route
 */
Route::get('auth/reset/{token}', function (string $token) {
    return view('auth.passwords.reset', ['token' => $token]);
});

/**
 * Reset Password Route
 */
Route::post('auth/reset', [AuthController::class, 'resetPassword'])->name('password.update');
