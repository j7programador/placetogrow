<?php

namespace App\Actions\MicroSites;

use App\Http\Requests\UpdateMicroSiteRequest;
use App\Models\MicroSite;

class UpdateAction
{
    public function execute(UpdateMicroSiteRequest $request, int $id): void
    {
        $request->validate([
            'slug' => 'required|string|max:30',
            'name' => 'required|string|max:100',
            'document_type' => 'required|in:' . implode(',', array_column(\App\Constants\DocumentTypeEnum::cases(), 'name')),
            'document' => 'required|string|max:30',
            'category' => 'required',
            'type_microsite' => 'required',
            'img_url' => 'nullable|url|max:500',
        ]);

        $microSite = MicroSite::query()->where('id', $id)->first();
        $microSite->update($request->all());

    }
}
