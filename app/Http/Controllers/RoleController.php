<?php

namespace App\Http\Controllers;

// use App\Models\role;

use App\Models\User;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $data = role::get();
        return view('admin.role.index', [
            'data' => $data
        ]);
    }
    public function edit($id, Request $request)
    {
        $role = role::find($id);
        $assignedPermissions = $role->permissions->pluck('name')->toArray();

        $Permission = Permission::all();
        $users = User::select('name', 'id')->get();
        $assignedUsers = $role->users->pluck('id')->toArray();
        return view('admin.role.edit', compact('role', 'Permission', 'users', 'assignedPermissions',  'assignedUsers'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required',

        ]);

        $role = Role::find($id);


        $role->update($request->all());
        foreach ($request->permission as $data) {
            $role->givePermissionTo($data);
        }

        foreach ($request->users as $user) {
            $user = User::find($user);
            $user->assignRole($role->name);
        }
        return redirect()->route('role')
            ->with('success', 'Role updated successfully.');
    }

    public function add(Request $request)
    {
        $Permission = Permission::all();
        $users = User::select('name', 'id')->get();
        return view('admin.role.add', compact('Permission', 'users'));
    }
    public function store(Request $request)
    {
        $role = role::create(['name' => $request->name, 'guard_name' => 'web']);

        foreach ($request->permission as $data) {
            $role->givePermissionTo($data);
        }

        foreach ($request->users as $user) {
            $user = User::find($user);
            $user->assignRole($role->name);
        }

        return route('role');
    }

    public function addPermission(Request $request)
    {
        // Permission::create(['name' => 'details']);
        Permission::create(['name' => "Add details"]);
    }
}
