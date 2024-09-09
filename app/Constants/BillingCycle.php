<?php

namespace App\Constants;

enum BillingCycle
{
    case YEARLY;
    case MONTHLY;
    case WEEKLY;
    case DAILY;

    public static function toArray(): array
    {
        return array_column(self::cases(), 'name');
    }
}
