<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Services\Facades\AuthFacade;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(AuthRequest $request)
    {
        return AuthFacade::register($request);
    }
}
