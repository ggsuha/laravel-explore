<?php

namespace App\Services\V1\User;

use App\Http\Requests\Api\V1\User\RegisterRequest;
use App\Repositories\V1\User\UserRepository;

class UserService
{
    /**
     * Construct function.
     *
     * @param \App\Repositories\V1\User\UserRepository $userRepository
     */
    public function __construct(
        private UserRepository $userRepository,
    ){}

    /**
     * Create user.
     *
     * @param  \App\Http\Requests\Api\V1\User\RegisterRequest  $request
     * @return \App\Models\User\User
     */
    public function create(RegisterRequest $request)
    {
        $user = $this->userRepository->createFromRequest($request->getUserData());

        return $user;
    }
}
