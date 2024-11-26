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
    public function register(AuthRequest $request) : AuthResource
    {
        return AuthFacade::register($request);
    }

    public function login(LoginRequest $request) : LoginResource
    {
        return AuthFacade::login($request);
    }

    public function refresh() : RefreshTokenResource
    {
        return AuthFacade::refresh();
    }

    public function me() : AuthResource
    {
        return AuthFacade::me();
    }

    public function forgotPassword(ResetPasswordRequest $request) : bool
    {
        return AuthFacade::forgotPassword($request);
    }

    public function resetPassword(ResetPasswordInfoRequest $request) : bool
    {
        return AuthFacade::resetPassword($request);
    }

    public function logout() : bool
    {
        return AuthFacade::logout();
    }
}
