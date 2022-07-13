<?php

namespace App\Http\Controllers\Api\V1\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\User\RegisterRequest;
use App\Http\Resources\Api\V1\User\UserWithTokenResource;
use App\Services\V1\User\UserService;

class RegisterController extends Controller
{
    /**
     * Construct function
     *
     * @param \App\Services\V1\User\UserService $service
     */
    public function __construct(private UserService $service) {}

    /**
     * Create user
     *
     * @param \App\Http\Requests\Api\V1\User\RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(RegisterRequest $request)
    {
        $user = $this->service->create($request);

        $user->access_token = $user->createToken($user->id)->accessToken;

        return UserWithTokenResource::make($user);
    }
}
