<?php

namespace App\Actions\Categories;

use App\Http\Requests\UpdateMicroSiteRequest;
use App\Models\Category;

class UpdateAction
{
    public function execute(UpdateMicroSiteRequest $request, int $id): void
    {
        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        $category = Category::query()->where('id', $id)->first();
        $category->update($request->all());

    }
}
