<?php

namespace App\Services\Dto;

use Carbon\Carbon;

class PetData
{
    public function __construct(
        private string  $name,
        private string  $type,
        private array   $colors,
        private ?Carbon $dateOfBirth,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'type' => $this->type,
            'colors' => $this->colors,
            'date_of_birth' => $this->dateOfBirth,
        ];
    }
}
