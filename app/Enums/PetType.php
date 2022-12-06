<?php

namespace App\Enums;

class PetType
{
    const DOG = 'dog';
    const CAT = 'cat';
    const BIRD = 'bird';
    const FISH = 'fish';
    const TURTLE = 'turtle';
    const PORPOISE = 'porpoise';

    public static function all(): array
    {
        return [
            self::DOG,
            self::CAT,
            self::BIRD,
            self::FISH,
            self::TURTLE,
            self::PORPOISE,
        ];
    }
}
