<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
        
    public function index()
    {
        // $user_id = Auth::user()->id;
        // $user = User::where('id' , $user_id)->first();
        // $admin_role = $user->roles;
        // $user = Auth::user()->id;
        // $role_user = User::where('id', $user)->first();
        // if($role_user->hasRole('user'))
        // {
        //     return "helllo";
        // }
        // else{
        //     return "eee";
        // }
        // }


        // $admin_role = Role::where('name', 'admin')->first();
        // return $admin_role->permissions->pluck('name');
        
            if(!Auth::user()->can('User show'))
            {
                return redirect()->back()->with('danger' , 'You do not have permission to complete this operation.');
            }
            $users = User::with('roles')->get();

            return view('dashboard.users.index', compact('users'));
    
            
    }

    public function create()
    {
        if(!Auth::user()->can('User create'))
        {
            return redirect()->back()->with('warning', 'You do not have the permission to complete this operation');
        }

        $roles = Role::all();
        return view('dashboard.users.add', compact('roles'));
    }


    public function store(Request $request)
    {
        return $request;
        if(!Auth::user()->can('User create'))
        {
            return redirect()->back()->with('warning', 'You do not have the permission to complete this operation');
        }
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', 'string'],
        ]);

        $data = $request->except('roles');


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $roles = $request->roles;
        $user->roles()->sync($roles);



        return redirect()->route('user.index')->with('success', 'New user is added');
    }

    public function destroy(string $id)
    {
        // return $id;
        $user = User::findOrfail($id);
        $user->delete();
        return redirect()->back()->with('danger' , "The user $user->name is deleted");
    }

}
