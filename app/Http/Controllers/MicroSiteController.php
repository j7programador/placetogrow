<?php

namespace App\Http\Controllers;

use App\Actions\MicroSites\DeleteAction;
use App\Constants\DocumentTypeEnum;
use App\Constants\Permissions;
use App\Models\MicroSite;
use App\Http\Requests\StoreMicroSiteRequest;
use App\Http\Requests\UpdateMicroSiteRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MicroSiteController extends Controller
{

    public function index(): \Inertia\Response
    {
        return Inertia::render('MicroSites', [
            'microsites' => MicroSite::all(),
            'canEdit' => auth()->user()->can(Permissions::MICROSITE_EDIT),
            'canCreate' => auth()->user()->can(Permissions::MICROSITE_CREATE),
        ]);
    }


    public function create() : \Inertia\Response
    {
        return Inertia::render('Microsite/Create', [
            'documentTypes' => array_column(DocumentTypeEnum::cases(), 'name'),
        ]);
    }


    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'slug' => 'required|unique:micro_sites,slug|max:30',
            'name' => 'required|max:100',
            'document_type' => 'required',
            'document' => 'required|max:30',
            'category_id' => 'required|exists:categories,id',
            'img_url' => 'nullable|url|max:500',
        ]);

        $microsite = new MicroSite();
        $microsite->fill($validated);
        $microsite->save();

        return to_route('microsites.index')->with('success', 'Microsite created successfully.');
    }


    public function show(int $id): \Inertia\Response
    {
        return Inertia::render('Microsite/View', [
            'microSite' => MicroSite::query()->where('id', $id)->find($id)
        ]);
    }


    public function edit(int $id): \Inertia\Response
    {
        return Inertia::render('Microsite/Edit', [
            'microSite' => MicroSite::query()->where('id', $id)->find($id),
            'documentTypes' => array_column(DocumentTypeEnum::cases(), 'name'),
        ]);

    }


    public function update(UpdateMicroSiteRequest $request, int $id): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'slug' => 'required|string|max:30',
            'name' => 'required|string|max:100',
            'document_type' => 'required|in:' . implode(',', array_column(\App\Constants\DocumentTypeEnum::cases(), 'name')),
            'document' => 'required|string|max:30',
            'category_id' => 'required|exists:categories,id',
            'img_url' => 'nullable|url|max:500',
        ]);

        $microSite = MicroSite::query()->where('id', $id)->first();
        $microSite->update($request->all());
        return to_route('microsites.index')->with('success', 'Micro Site updated successfully.');

    }


    public function destroy(int $id, DeleteAction $deleteAction): \Illuminate\Http\RedirectResponse
    {
        $deleteAction->execute($id);
        return to_route('microsites.index')->with('success', 'Item eliminado con éxito');
    }
}
