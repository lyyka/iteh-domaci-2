<?php

namespace App\Services\Storage;

class PetImageStorage extends StorageFolder
{
    public static function IMAGES(): self
    {
        return new self('/pet-images');
    }
}
