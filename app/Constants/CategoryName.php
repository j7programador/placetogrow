<?php

namespace App\Constants;

enum CategoryName: string
{
    case BASIC = 'BASIC';
    case INVOICING = 'INVOICING';
    case SUBSCRIPTIONS = 'SUBSCRIPTIONS';

    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function text(): string
    {
        return match ($this) {
            self::BASIC => trans('categories.basic'),
            self::INVOICING => trans('categories.invoicing'),
            self::SUBSCRIPTIONS => trans('categories.subscriptions'),
        };
    }
}
