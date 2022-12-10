<?php

namespace App\Services\Dto;

use Illuminate\Support\Facades\Hash;

class UserRegisterData
{
    public function __construct(
        private string $name,
        private string $username,
        private string $email,
        private string $password,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
        ];
    }

    /**
     * @return string
     */
    public function getHashedPassword(): string
    {
        return Hash::make($this->password);
    }
}
