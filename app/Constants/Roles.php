<?php

namespace App\Constants;

final class Roles
{
    public const  ADMIN = 'Admin';
    public const  CUSTOMER = 'Customer';
    public const GUEST = 'Guest';

    public static function toArray() : array {
        return (new \ReflectionClass(self::class))->getConstants();
    }
}
