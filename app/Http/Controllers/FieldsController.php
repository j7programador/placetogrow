<?php

namespace App\Http\Controllers;

use App\Constants\Permissions;
use App\Models\Fields;
use App\Models\Site;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class FieldsController extends Controller
{
    public function index()
    {
        return Inertia::render('Fields/Fields', [
            'microsites' => Site::all(),
            'canViewDashBoard' => auth()->user()->can(Permissions::DASHBOARD_VIEW),
            'canViewUsers' => auth()->user()->can(Permissions::USER_VIEW),
            'canViewRoles' => auth()->user()->can(Permissions::ROLE_VIEW),
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Fields $fields)
    {
        //
    }

    public function edit(int $id): Response
    {
        $microsite = Site::query()->where('id', $id)->first();
        $microsite->load('fields');

        return Inertia::render('Fields/Edit', [
            'microsite' => $microsite,
            'fields' => Fields::query()->where('site_id', $microsite->id)->where('enabled', true)->get(),
            'fieldsDisabled' => Fields::query()->where('site_id', $microsite->id)->where('enabled', false)->get(),
            'canViewDashBoard' => auth()->user()->can(Permissions::DASHBOARD_VIEW),
            'canViewUsers' => auth()->user()->can(Permissions::USER_VIEW),
            'canViewRoles' => auth()->user()->can(Permissions::ROLE_VIEW),
        ]);
    }

    public function update(Request $request, int $siteId)
    {
        $fieldsActive = $request->fields;
        $fields = Fields::query()->where('site_id', $request->input('siteId'))->get();

        foreach ($fields as $field) {

            $field->update(['enabled' => false]);

        }

        foreach ($fieldsActive as $field) {
            $fieldUpdate = Fields::query()->where('id', $field['id'])->first();
            $fieldUpdate->update(['enabled' => true]);
        }
        return to_route('fields.index')->with('success', 'Fields updated successfully');

    }

    public function destroy(Fields $fields)
    {
        //
    }
}
