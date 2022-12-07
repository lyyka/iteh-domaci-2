<?php

namespace App\Services\Dto;

use Carbon\Carbon;
use Illuminate\Http\UploadedFile;

class PetData
{
    public function __construct(
        private string  $name,
        private string  $type,
        private array   $colors,
        private ?Carbon $dateOfBirth,
        private ?UploadedFile $image,
    )
    {
    }

    /**
     * @return UploadedFile|null
     */
    public function getImage(): ?UploadedFile
    {
        return $this->image;
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
