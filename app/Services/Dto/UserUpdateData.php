<?php

namespace App\Services\Dto;

class UserUpdateData
{
    public function __construct(
        private string $name,
        private string $email,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email
        ];
    }
}
