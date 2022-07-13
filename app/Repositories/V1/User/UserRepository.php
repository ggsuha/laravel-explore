<?php

namespace App\Repositories\V1\User;

use App\Entities\UserEntity;
use App\Models\User\User;

class UserRepository
{
    /**
     * Store the data into storage from the given request.
     *
     * @param  array  $data
     * @return \App\Models\User\User
     */
    public function createFromRequest(array $data): User
    {
        return $this->create(UserEntity::make($data));
    }

    /**
     * Store the given data into storage.
     *
     * @param \App\Entity\User $entity
     * @return \App\Models\User\User
     */
    public function create(UserEntity $entity): User
    {
        $user = $entity->toModel();

        $user->save();

        return $user->fresh();
    }
}
