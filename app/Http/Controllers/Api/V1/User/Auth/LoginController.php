<?php

namespace App\Http\Controllers\Api\V1\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\User\LoginRequest;
use App\Http\Resources\Api\V1\User\UserWithTokenResource;
use App\Models\User\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Authenticate login user.
     *
     * @param  \App\Http\Requests\Api\V1\User\LoginRequest $request
     * @return \App\Http\Resources\Api\V2\User\AuthResource
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function __invoke(LoginRequest $request)
    {
        $this->ensureIsNotRateLimited($request);

        $user = User::query()
            ->whereEmail($request->input('email'))
            ->first();

        if (!$user) {
            $this->hitRateLimiter($request);

            throw ValidationException::withMessages([
                'email' => 'The provided credentials are incorrect.',
            ]);
        }

        if (!Hash::check($request->input('password'), $user->password)) {
            $this->hitRateLimiter($request);

            throw ValidationException::withMessages([
                'password' => 'The password credentials are incorrect.',
            ]);
        }

        $user->access_token = $user->createToken($user->id)->accessToken;

        return UserWithTokenResource::make($user);
    }

    /**
     * Ensure the login request is not rate limited.
     * 
     * @param  \App\Http\Requests\Api\V1\User\LoginRequest $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(LoginRequest $request)
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey($request), 5)) {
            return;
        }

        event(new Lockout($request));

        $seconds = RateLimiter::availableIn($this->throttleKey($request));

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @return string
     */
    public function throttleKey(Request $request)
    {
        return $request->input('email') . '|' . $request->ip();
    }

    /**
     * Determine to retrieve the number of attempts.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function hitRateLimiter(Request $request)
    {
        return RateLimiter::hit($this->throttleKey($request));
    }
}
