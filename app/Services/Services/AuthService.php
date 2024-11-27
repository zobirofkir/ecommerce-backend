<?php
namespace App\Services\Services;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ResetPasswordInfoRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Resources\AuthResource;
use App\Http\Resources\LoginResource;
use App\Http\Resources\RefreshTokenResource;
use App\Jobs\ForgetPasswordJob;
use App\Models\User;
use App\Notifications\ResetPasswordNotification;
use App\Services\Constructors\AuthConstructor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

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

    public function refresh() : RefreshTokenResource
    {
        return RefreshTokenResource::make(Auth::user());
    }

    public function me() : AuthResource
    {
        return AuthResource::make(Auth::user());
    }

    public function forgotPassword(ResetPasswordRequest $request): bool
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            ForgetPasswordJob::dispatch($user);
        }

        return true;
    }

    public function resetPassword(ResetPasswordInfoRequest $request): bool
    {
        $status = Password::broker()->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return true;
        }

        return false;
    }

    public function logout() : bool
    {
        return User::find(Auth::id())->tokens()->delete() ? true : false;
    }
}
