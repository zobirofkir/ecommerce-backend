<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\AuthResource;
use App\Http\Resources\LoginResource;
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
}
