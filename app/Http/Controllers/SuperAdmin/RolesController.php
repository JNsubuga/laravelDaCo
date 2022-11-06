<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
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
        // $toPermite = Role::where('id', $id)->first();
        $toDetail = Role::where('id', $id)->first();
        $permits = Permission::get();
        return view('superadmins.roles.show', ['toDetail' => $toDetail, 'permits' => $permits]);
    }

    public function grantPermission(Request $request, $id)
    {
        $role = Role::where('id', $id)->first();
        if ($role->hasPermissionTo($request->permission)) {
            return back()->with('error', 'Permission already granted to this role!!!');
        }
        $role->givePermissionTo($request->permission);
        return back()->with('success', 'Permission granted to this Role!!');
    }

    public function revokePermission($roleId, $permissionId)
    {
        $role = Role::where('id', $roleId)->first();
        $permission = Permission::where('id', $permissionId)->first();

        if ($role->hasPermissionTo($permission)) {
            $role->revokePermissionTo($permission);
            return back()->with('success', 'Permission revoked from this role!!');
        }
        return back()->with('error', 'Permission not yet granted to this role!!!');
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
