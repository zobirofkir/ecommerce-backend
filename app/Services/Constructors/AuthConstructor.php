<?php
namespace App\Services\Constructors;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\AuthResource;
use App\Http\Resources\LoginResource;

interface AuthConstructor
{
    public function register(AuthRequest $request) : AuthResource;

    public function login(LoginRequest $request) : LoginResource;

    public function logout() : bool;

    public function refresh() : AuthResource;

    public function me() : AuthResource;

    public function forgot(AuthRequest $request) : AuthResource;
}
