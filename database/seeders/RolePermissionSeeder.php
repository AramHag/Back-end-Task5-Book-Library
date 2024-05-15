<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private $permissions = ['show', 'create', 'update', 'delete' , 'trash',];
    private $modelsDirectory;
    private $modelNames;
    private $modelFiles;
    public function run(): void
    {
        $this->modelsDirectory = app_path('Models');
        // $this->modelFiles = File::files($this->modelsDirectory);
        $this->modelFiles = File::allFiles($this->modelsDirectory);
        // Extract the model class names from the file paths
        $this->modelNames = collect($this->modelFiles)
            ->map(function ($file) {
                // Get the file name without the extension
                $fileName = pathinfo($file, PATHINFO_FILENAME);
                return "$fileName";
            })
            ->push('Role' , 'Permission');
            // meger is new 
            // ->merge($this->customPermissions)->toArray();
        $role = Role::create(['name' => 'admin']);
        $role1 = Role::create(['name' => 'user']);
        $role->save();
        $role1->save();
        foreach ($this->modelNames as $modelName) {
            foreach ($this->permissions as $permission) {
                $permission = Permission::create(['name' => $modelName . ' ' . $permission]);
                if($permission->save())
                $role->givePermissionTo($permission);
                // $role1->givePermissionTo($permission);
            }
        }
        $custom_permissions = [
            'Book add to fovorite' , 'Book remove from fovorite' , 'Book library index',
        ];
        foreach($custom_permissions as $cus_per)
        Permission::create([
            'name' => $cus_per,
        ]);


    }
}
