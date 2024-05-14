<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return RoleResource::collection($roles);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'name' => ['required', 'string', 'max:255', "unique:roles,name"],
        ]);

        $role = Role::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'data' => $role,
            'code' => 200,
            'message' => 'New role is added',
        ]); 
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', "unique:roles,name,$id"],
        ]);
        $role = Role::where('id' , $id)->first();
        $role->update([
            'name' => $request->name,
        ]);
        return response()->json([
            'data' => $role,
            'code' => 200,
            'message' => 'Thr role is updated',
        ]);

    }

    /**
     * Remove the specified resource from storage to trash.
     */
    public function destroy(string $id)
    {
        // return $id;
        $role = Role::where('id', $id)->first();
        
        $role->delete();
        return response()->json( [
            'data' => $role ,
            'code' => '200',
            'message' => 'The role is deleted and moved to the trash',
        ]);
    }
    //  ====================  TRASHED  =================
    public function trashed()
    {
        $trashed_roles = Role::onlyTrashed()->get();
        return RoleResource::collection($trashed_roles);
    }
    
    //  ====================  Restore  =================
    public function restore(string $id)
    {
        $restore_role = Role::onlyTrashed()->findOrFail($id);
        // return $restore_role;
        $restore_role->restore();
        
        return response()->json([
            'data' => $restore_role,
            'code'=> 200,
            'message' => 'The role has been restored',
        ]);
    }
    
    //  ====================  Permenantly Delete from Trash  =================
    
    public function forceDelete(string $id)
    {

        $role = Role::onlyTrashed()->where('id', $id)->first();
        $role->forceDelete();
        return response()->json([
            'data' => $role,
            'code' => 200,
            'message ' =>  "The role " . " $role->name " . " is force deleted."
        ]);
    }
}
