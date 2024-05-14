<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use function Laravel\Prompts\table;

class RoleController extends Controller
{
    public function index()
    {

        $user = Auth::user();
        if (!$user->can('Role show')) {
            return redirect()->back()->with('warning', 'You do not have the permission to complete this operation.');
        }
        $roles = Role::all();
        return view('dashboard.roles.index', compact('roles'));
    }

    public function create()
    {
        if (!Auth::user()->can('Role create')) {
            return redirect()->back()->with('warning', 'You do not have the permission to complete this operation.');
        }

        return view('dashboard.roles.add');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255', "unique:roles,name"],
        ]);

        Role::create([
            'name' => $request->name,
        ]);

        return redirect()->route('role.index')->with('success', 'New role is added');
    }

    public function edit(Role $role)
    {
        if (!Auth::user()->can('Role update')) {
            return redirect()->back()->with('warning', 'You do not have the permission to complete this operation.');
        }
        // return $role_id = $role->id;

        $role = Role::where('id', $role->id)->first();
        // $rr = DB::table('role_has_permissions')->where('permissions')
        // $unassigned_permissions = DB::select("select * from  permissions  where  permissions.id not in (select permission_id  from  role_has_permissions  where role_id = $role->id ) ");
        $unassigned_permissions =DB::table('permissions')
        ->whereNotIn('permissions.id', function ($query) use ($role) {
                $query->select('permission_id')
                    ->from('role_has_permissions')
                    ->where('role_id', $role->id);
            })->get();


        $permissions =DB::table('permissions')
        ->whereIn('permissions.id', function ($query) use ($role) {
                $query->select('permission_id')
                    ->from('role_has_permissions')
                    ->where('role_id', $role->id);
            })->orderBy('id')->get();
            

            

        // return $permissions = $role->permissions;
        // return $per = $permissions->sortBy('name');
        
        
        return view('dashboard.roles.edit', compact('role', 'permissions', 'unassigned_permissions'));
    }

    public function update(Role $role, Request $request)
    {
        if (!Auth::user()->can('Role delete')) {
            return redirect()->back()->with('warning', 'You do not have the permission to complete this operation.');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255', "unique:roles,name,$role->id"],
        ]);

        $role->update([
            'name' => $request->name,
        ]);

        return redirect()->route('role.index')->with('success', 'The role is updated.');
    }


    public function assignPermission(Role $role , string $id)
    {
        // return $id;
        // return $role;
        $permission = Permission::where('id' , $id)->first();
        $role->givePermissionTo($permission);
        return redirect()->back();

    }

    public function revokePermission(Role $role , string $id)
    {
        // return $id;
        // return $role;
        $permission = Permission::where('id' , $id)->first();
        $role->revokePermissionTo($permission);
        return redirect()->back();

    }
    public function destroy(Role $role)
    {
        if (!Auth::user()->can('role delete')) {
            return redirect()->back()
                ->with('warning', 'You do not have the permission to compolete this operation.');
        }

        $role->delete();
        return redirect()->route('role.index')->with('success', 'The role is deleted');
    }

    public function trashed()
    {
        $trashed_roles = Role::onlyTrashed()->get();
        return view('dashboard.roles.trashed', compact('trashed_roles'));
    }

    public function restore(string $id)
    {
        $restore_role = Role::onlyTrashed()->findOrFail($id);
        // return $restore_role;
        $restore_role->restore();

        return redirect()->route('role.index')->with('success', "The role" . " $restore_role->name" . " is restored ");
    }

    public function forceDelete(string $id)
    {

        $role = Role::onlyTrashed()->where('id', $id)->first();
        $role->forceDelete();
        return redirect()->back()->with('danger', "The role " . " $role->name " . " is force deleted.");
    }
}
