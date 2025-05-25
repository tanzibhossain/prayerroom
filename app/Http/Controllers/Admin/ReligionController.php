<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Religion;
use App\Models\ListingReligion;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ReligionController extends Controller
{
    public function index()
    {
        $religions = Religion::all();
        return view('admin.religion_view', compact('religions'));
    }

    public function create()
    {
        return view('admin.religion_create');
    }

    public function store(Request $request)
    {
        if (env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $request->validate([
            'religion_name' => 'required|unique:religions,name',
        ], [
            'religion_name.required' => ERR_NAME_REQUIRED,
            'religion_name.unique' => ERR_NAME_EXIST,
        ]);

        $religion = new Religion();
        $religion->name = $request->religion_name;
        $religion->save();

        return redirect()->route('admin_religion_view')->with('success', SUCCESS_DATA_ADD);
    }

    public function edit($id)
    {
        $religion = Religion::findOrFail($id);
        return view('admin.religion_edit', compact('religion'));
    }

    public function update(Request $request, $id)
    {
        if (env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        $request->validate([
            'religion_name' => [
                'required',
                Rule::unique('religions', 'name')->ignore($id),
            ],
        ], [
            'religion_name.required' => ERR_NAME_REQUIRED,
            'religion_name.unique' => ERR_NAME_EXIST,
        ]);

        $religion = Religion::findOrFail($id);
        $religion->name = $request->religion_name;
        $religion->save();

        return redirect()->route('admin_religion_view')->with('success', SUCCESS_DATA_UPDATE);
    }

    public function destroy($id)
    {
        if (env('PROJECT_MODE') == 0) {
            return redirect()->back()->with('error', env('PROJECT_NOTIFICATION'));
        }

        // Check if religion is used in listing_religions table
        $tot = ListingReligion::where('religion_id', $id)->count();
        if ($tot) {
            return redirect()->back()->with('error', ERR_ITEM_DELETE);
        }

        // Delete religion
        $religion = Religion::findOrFail($id);
        $religion->delete();

        return redirect()->back()->with('success', SUCCESS_DATA_DELETE);
    }
}
