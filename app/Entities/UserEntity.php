<?php

namespace App\Entities;

use App\Infrastructure\Entity\Entity;
use App\Models\User\User;

class UserEntity extends Entity
{
    public $name;

    public $email;

    public $password;

    /**
     * {@inheritDoc}
     *
     * @return \App\Models\User\User
     */
    public function toModel(): User
    {
        return User::make([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);
    }
}
