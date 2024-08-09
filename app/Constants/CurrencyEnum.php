<?php

namespace App\Constants;

enum CurrencyEnum
{
    case COP;
    case USD;

    public static function toArray(): array
    {
        return array_column(self::cases(), 'name');
    }
}
