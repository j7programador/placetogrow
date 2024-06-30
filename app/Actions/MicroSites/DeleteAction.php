<?php

namespace App\Actions\MicroSites;

use App\Models\MicroSite;

class DeleteAction
{
    public function execute(int $id): void
    {
        MicroSite::destroy($id);
    }
}
