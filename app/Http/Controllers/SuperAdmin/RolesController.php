<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function index()
    {
        $roles = Role::whereNotIn('name', ['SuperAdmin'])->get();
        return view('superadmins.roles.index', ['roles' => $roles]);
    }

    public function create()
    {
        return view('superadmins.roles.create');
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required'
        ]);

        Role::create($formFields);

        return to_route('superadmin.roles.index')->with('success', 'Role created successfully!!');
    }

    public function show($id)
    {
        $toPermite = Role::where('id', $id)->first();
        return view('superadmins.roles.show');
    }

    public function edit($id)
    {
        $toEdit = Role::where('id', $id)->first();
        return view('superadmins.roles.edit', ['toEdit' => $toEdit]);
    }

    public function update(Request $request, $id)
    {
        $formFields = $request->validate([
            'name' => 'required'
        ]);
        Role::where('id', $id)->update($formFields);
        return to_route('superadmin.roles.index')->with('success', 'Role updated successfully!!');
    }

    public function destroy($id)
    {
        Role::destroy($id);
        return to_route('superadmin.roles.index')->with('success', 'Role deleted successfully!!');
    }
}
