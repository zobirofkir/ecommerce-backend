<?php
namespace App\Services\Services;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\AuthResource;
use App\Http\Resources\LoginResource;
use App\Models\User;
use App\Services\Constructors\AuthConstructor;
use Illuminate\Support\Facades\Hash;

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

    public function login(LoginRequest $request) : LoginResource
    {
        $validatedData = $request->validated();
        $user = User::where('email', $validatedData['email'])->first();

        if (!$user || !Hash::check($validatedData['password'], $user->password)) {
            abort(401);
        }

        return LoginResource::make($user);
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
