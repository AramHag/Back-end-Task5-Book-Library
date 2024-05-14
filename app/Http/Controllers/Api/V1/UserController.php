<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    

    // ========  Get all Users =========
    
    public function index()
    {
        $users = User::all();
        return UserResource::collection($users);
    }
    
    // ========  Get all Users =========
    
    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
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
        return response()->json([
            'date' => $user,
            'assigned_roles' => $roles,
            'code' => 200,
            'message' => "New user is added",
        ]);
    }
    
    
    // ========  Get all Users =========
    public function destroy(string $id)
    {
        // return $id;
        $user = User::findOrfail($id);
        $user->delete();
        return response()->json([
            'code' => '200',
            'message' => "The user $user->name is deleted",
        ]);
    }
}
