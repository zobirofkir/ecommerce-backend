<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ResetPasswordInfoRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Resources\AuthResource;
use App\Http\Resources\LoginResource;
use App\Http\Resources\RefreshTokenResource;
use App\Services\Facades\AuthFacade;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Register User
     *
     * @param AuthRequest $request
     * @return AuthResource
     */
    public function register(AuthRequest $request) : AuthResource
    {
        return AuthFacade::register($request);
    }

    /**
     * Login User
     *
     * @param LoginRequest $request
     * @return LoginResource
     */
    public function login(LoginRequest $request) : LoginResource
    {
        return AuthFacade::login($request);
    }

    /**
     * Refresh Token
     *
     * @return RefreshTokenResource
     */
    public function refresh() : RefreshTokenResource
    {
        return AuthFacade::refresh();
    }

    /**
     * Get User
     *
     * @return AuthResource
     */
    public function me() : AuthResource
    {
        return AuthFacade::me();
    }

    /**
     * Forgot Password
     *
     * @param ResetPasswordRequest $request
     * @return boolean
     */
    public function forgotPassword(ResetPasswordRequest $request) : bool
    {
        return AuthFacade::forgotPassword($request);
    }

    /**
     * Reset Password
     *
     * @param ResetPasswordInfoRequest $request
     * @return void
     */
    public function resetPassword(ResetPasswordInfoRequest $request)
    {
        return AuthFacade::resetPassword($request);
    }

    /**
     * Logout User
     *
     * @return boolean
     */
    public function logout() : bool
    {
        return AuthFacade::logout();
    }
}
