<?php

namespace App\Enums;

class PetColor
{
    const BLACK = 'black';
    const WHITE = 'white';
    const RED = 'red';
    const GREEN = 'green';
    const BLUE = 'blue';
    const YELLOW = 'yellow';
    const ORANGE = 'orange';
    const PURPLE = 'purple';
    const MAGENTA = 'magenta';
    const TEAL = 'teal';

    public static function all(): array
    {
        return [
            self::BLACK,
            self::WHITE,
            self::RED,
            self::GREEN,
            self::BLUE,
            self::YELLOW,
            self::ORANGE,
            self::PURPLE,
            self::MAGENTA,
            self::TEAL,
        ];
    }
}
