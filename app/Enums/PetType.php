<?php

namespace App\Enums;

class PetType
{
    const DOG = 'dog';
    const CAT = 'cat';
    const BIRD = 'bird';
    const PORPOISE = 'porpoise';

    public static function all() : array
    {
        return [
            self::DOG,
            self::CAT,
            self::BIRD,
            self::PORPOISE,
        ];
    }
}
