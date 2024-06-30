<?php

namespace App\Actions\Users;

use App\Models\User;

class DeleteAction
{
    public function execute($id): void
    {
        User::destroy($id);
    }
}
