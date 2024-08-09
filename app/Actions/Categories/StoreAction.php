<?php

namespace App\Actions\Categories;

use App\Models\Category;
use Illuminate\Http\Request;

class StoreAction
{
    public function execute(Request $request): void
    {
        $validated = $request->validate([
            'name' => 'required|max:100',
        ]);

        $category = new Category;
        $category->fill($validated);
        $category->save();
    }
}
