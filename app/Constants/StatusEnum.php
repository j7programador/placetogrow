<?php

namespace App\Constants;

enum StatusEnum : int
{
    case FAILED = 1;
    case OK = 2;
    case PENDING = 3;
    case APPROVED = 4;
    case REJECTED = 5;
    case EXPIRED = 6;

    public static function toArray(): array
    {
        return array_column(self::cases(), 'name');
    }

}
