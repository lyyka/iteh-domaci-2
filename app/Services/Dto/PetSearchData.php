<?php

namespace App\Services\Dto;

class PetSearchData
{
    public function __construct(
        private string $query,
        private ?string $type,
    ) { }

    /**
     * @return string
     */
    public function getQuery(): string
    {
        return $this->query;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }
}
