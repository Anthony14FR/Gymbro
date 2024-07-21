<?php

namespace App\Enums;

enum RankEnum: string
{
    case F = 'F';
    case E = 'E';
    case D = 'D';
    case C = 'C';
    case B = 'B';
    case A = 'A';
    case S = 'S';
    case SS = 'SS';
    case SSS = 'SSS';

    public static function fromLevel(int $level): self
    {
        return match(true) {
            $level < 2 => self::F,
            $level <= 10 => self::E,
            $level <= 20 => self::D,
            $level <= 35 => self::C,
            $level <= 45 => self::B,
            $level <= 60 => self::A,
            $level <= 75 => self::S,
            $level <= 90 => self::SS,
            $level >= 100 => self::SSS,
        };
    }
}