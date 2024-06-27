<?php

namespace App\Constants;

final class Permissions
{
    public const  MICROSITE_VIEW = 'microsite_view';
    public const  MICROSITE_ANY = 'microsite_viewAny';
    public const MICROSITE_EDIT = 'microsite_edit';
    public const MICROSITE_DELETE = 'microsite_delete';
    public const MICROSITE_CREATE = 'microsite_create';

    public static function toArray() : array {
        return (new \ReflectionClass(self::class))->getConstants();
    }
}
