<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    public function index()
    {
        $permissions = Permission::get();
        return view('superadmins.permissions.index', ['permissions' => $permissions]);
    }

    public function create()
    {
        return view('superadmins.permissions.create');
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required'
        ]);

        Permission::create($formFields);

        return to_route('superadmin.permissions.index')->with('success', 'Permission created successfully!!');
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $toEdit = Permission::where('id', $id)->first();

        return view('superadmins.permissions.edit', ['toEdit' => $toEdit]);
    }

    public function update(Request $request, $id)
    {
        $formFields = $request->validate([
            'name' => 'required'
        ]);

        Permission::where('id', $id)->update($formFields);

        return to_route('superadmin.permissions.index')->with('success', 'Permission updated syccessfully!!');
    }

    public function destroy($id)
    {
        Permission::destroy($id);
        return to_route('superadmin.permissions.index')->with('success', 'Permission deleted successully!!');
    }
}
