<?php

namespace App\Constants;

enum TypeSubscriptionEnum
{
    case BASIC;
    case MEDIUM;
    case PREMIUM;

    public static function toArray(): array
    {
        return array_column(self::cases(), 'name');
    }
}
