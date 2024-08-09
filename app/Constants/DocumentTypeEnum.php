<?php

namespace App\Constants;

enum DocumentTypeEnum
{
    case CC;
    case NIT;
    case RUT;
    case CE;
    case PPT;

    public static function toArray(): array
    {
        return array_column(self::cases(), 'name');
    }
}
