<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::get();
        return view('superadmins.users.index', ['users' => $users]);
    }

    public function create()
    {
    }

    public function store()
    {
    }

    public function show($id)
    {
        $user = User::where('id', $id)->first();
        $roles = Role::get();
        $permissions = Permission::get();
        return view('superadmins.users.show', [
            'user' => $user,
            'roles' => $roles,
            'permissions' => $permissions
        ]);
    }

    public function assignRole(Request $request, $userId)
    {
        $user = User::where('id', $userId)->first();
        if ($user->hasRole($request->role)) {
            return back()->with('error', 'Role already assigned to this User!!!');
        }
        $user->assignRole($request->role);
        return back()->with('success', 'Role assigned to this user successfully!!');
    }

    public function removeRole($userId, $roleId)
    {
        $user = User::where('id', $userId)->first();
        $role = Role::where('id', $roleId)->first();
        if ($user->hasRole($role)) {
            $user->removeRole($role);
            return back()->with('success', 'Role removed successfully!!');
        }
        return back()->with('error', 'Role not yet Assigned to this Permissoin!!!');
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

    public function edit()
    {
    }

    public function update()
    {
    }

    public function destroy()
    {
    }
}
