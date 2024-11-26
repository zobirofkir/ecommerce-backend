<?php
namespace App\Services\Constructors;

use App\Http\Requests\AuthRequest;
use App\Http\Resources\AuthResource;

interface AuthConstructor
{
    public function register(AuthRequest $request) : AuthResource;

    public function loging(AuthRequest $request) : AuthResource;

    public function logout() : bool;

    public function refresh() : AuthResource;

    public function me() : AuthResource;

    public function forgot(AuthRequest $request) : AuthResource;
}
