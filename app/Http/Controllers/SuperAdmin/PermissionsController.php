<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
        $toDetail = Permission::where('id', $id)->first();
        $roles = Role::all();
        return view('superadmins.permissions.show', ['toDetail' => $toDetail, 'roles' => $roles]);
    }

    public function assignRole(Request $request, $permissionId)
    {
        $permission = Permission::where('id', $permissionId)->first();
        if ($permission->hasRole($request->role)) {
            return back()->with('error', 'Role already assigned to this Permission!!!');
        }
        $permission->assignRole($request->role);
        return back()->with('success', 'Role assigned to this permission successfully!!');
    }

    public function removeRole($permissionId, $roleId)
    {
        $permission = Permission::where('id', $permissionId)->first();
        $role = Role::where('id', $roleId)->first();
        if ($permission->hasRole($role)) {
            $permission->assignRemove($role);
        }
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
