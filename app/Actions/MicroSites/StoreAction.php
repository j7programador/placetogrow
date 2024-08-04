<?php

namespace App\Actions\MicroSites;

use App\Models\Site;
use Illuminate\Http\Request;

class StoreAction
{
    public function execute(StoreAction $storeAction, Request $request): void
    {
        $validated = $request->validate([
            'slug' => 'required|unique:sites,slug|max:30',
            'name' => 'required|max:100',
            'document_type' => 'required',
            'document' => 'required|max:30',
            'category_id' => 'required',
            'type_microsite' => 'required',
            'img_url' => 'nullable|url|max:500',
        ]);

        $microsite = new Site;
        $microsite->fill($validated);
        $microsite->save();

        $defaultFields = [
            ['label' => 'reference', 'type' => 'string', 'enabled' => true, 'personal_info' => false],
            ['label' => 'description', 'type' => 'string', 'enabled' => true, 'personal_info' => false],
            ['label' => 'currency', 'type' => 'selector', 'enabled' => true, 'personal_info' => false],
            ['label' => 'amount', 'type' => 'integer', 'enabled' => true, 'personal_info' => false],
            ['label' => 'email', 'type' => 'string', 'enabled' => true],
            ['label' => 'document_number', 'type' => 'numeric', 'enabled' => true],
            ['label' => 'document_type', 'type' => 'selector', 'enabled' => true],
            ['label' => 'name', 'type' => 'string', 'enabled' => true],
            ['label' => 'last_name', 'type' => 'string', 'enabled' => true],
            ['label' => 'gateway', 'type' => 'selector', 'enabled' => true, 'personal_info' => false],
        ];

        foreach ($defaultFields as $field) {
            $microsite->fields()->create($field);
        }
    }
}
