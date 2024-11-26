<?php
namespace App\Services\Services;

use App\Http\Requests\AuthRequest;
use App\Http\Resources\AuthResource;
use App\Models\User;
use App\Services\Constructors\AuthConstructor;

class AuthService implements AuthConstructor
{
    public function register(AuthRequest $request) : AuthResource
    {
        $validatedData = $request->validated();

        if (isset($validatedData['image'])) {
            $imagePath = $validatedData['image']->store('images', 'public');
            $validatedData['image'] = $imagePath;
        }

        $user = User::create($validatedData);

        return AuthResource::make($user);
    }

    public function loging(AuthRequest $request) : AuthResource
    {
        //
    }

    public function logout() : bool
    {
        //
    }

    public function refresh() : AuthResource
    {
        //
    }

    public function me() : AuthResource
    {
        //
    }

    public function forgot(AuthRequest $request) : AuthResource
    {
        //
    }
}
