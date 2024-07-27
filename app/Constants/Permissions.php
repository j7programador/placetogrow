<?php

namespace App\Constants;

final class Permissions
{
    public const MICROSITE_VIEW = 'microsite_view';

    public const MICROSITE_ANY = 'microsite_viewAny';

    public const MICROSITE_EDIT = 'microsite_edit';

    public const MICROSITE_DELETE = 'microsite_delete';

    public const MICROSITE_CREATE = 'microsite_create';

    public const USER_CREATE = 'user-create';

    public const USER_EDIT = 'user-edit';

    public const USER_DELETE = 'user-delete';

    public const USER_VIEW = 'user-view';

    public const ROLE_VIEW = 'role-view';

    public const ROLE_EDIT = 'role-edit';

    public const DASHBOARD_VIEW = 'dashboard-view';

    public static function toArray(): array
    {
        return (new \ReflectionClass(self::class))->getConstants();
    }
}
