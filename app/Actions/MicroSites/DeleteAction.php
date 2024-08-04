<?php

namespace App\Actions\MicroSites;

use App\Models\Site;

class DeleteAction
{
    public function execute(int $id): void
    {
        Site::destroy($id);
    }
}
