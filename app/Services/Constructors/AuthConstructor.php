<?php
namespace App\Services\Constructors;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ResetPasswordInfoRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\ResetPasswordResource;
use App\Http\Resources\AuthResource;
use App\Http\Resources\LoginResource;
use App\Http\Resources\RefreshTokenResource;

interface AuthConstructor
{
    public function register(AuthRequest $request) : AuthResource;

    public function login(LoginRequest $request) : LoginResource;

    public function logout() : bool;

    public function refresh() : RefreshTokenResource;

    public function me() : AuthResource;

    public function forgotPassword(ResetPasswordRequest $request) : bool;

    public function resetPassword(ResetPasswordInfoRequest $request) ;

}
