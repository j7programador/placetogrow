<?php

namespace App\Actions\MicroSites;

use App\Models\MicroSite;
use Illuminate\Http\Request;

class StoreAction
{
    public function execute(StoreAction $storeAction, Request $request): void
    {
        $validated = $request->validate([
            'slug' => 'required|unique:micro_sites,slug|max:30',
            'name' => 'required|max:100',
            'document_type' => 'required',
            'document' => 'required|max:30',
            'category_id' => 'required',
            'type_microsite' => 'required',
            'img_url' => 'nullable|url|max:500',
        ]);

        $microsite = new MicroSite;
        $microsite->fill($validated);
        $microsite->save();
    }
}
