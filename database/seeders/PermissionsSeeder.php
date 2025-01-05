<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        // Permissions
        $permissions = [
            ['name' => 'servicecategories.index','nickname_ar'=>'servicecategories.index' , 'nickname_en'=>'servicecategories.index', 'guard_name' => 'web'], // Added permission
            ['name' => 'servicecategories.create','nickname_ar'=>'servicecategories.create' , 'nickname_en'=>'servicecategories.create', 'guard_name' => 'web'], // Added permission
            ['name' => 'servicecategories.edit','nickname_ar'=>'servicecategories.edit' , 'nickname_en'=>'servicecategories.edit', 'guard_name' => 'web'], // Added permission
            ['name' => 'servicecategories.destroy','nickname_ar'=>'servicecategories.destroy' , 'nickname_en'=>'servicecategories.destroy', 'guard_name' => 'web'], // Added permission
            ['name' => 'servicecategories.deleteAll','nickname_ar'=>'servicecategories.deleteAll' , 'nickname_en'=>'servicecategories.deleteAll', 'guard_name' => 'web'], // Added permission
            // Add more permissions as needed
        ];

        // Create or update permissions
        foreach ($permissions as $permissionData) {
            Permission::updateOrCreate(['name' => $permissionData['name']], $permissionData);
        }

        // Assign all permissions to super-admin
        $superAdminRole = Role::where('name', 'super-admin')->first();
        if ($superAdminRole) {
            $superAdminRole->syncPermissions(Permission::all());
        }
    }
}
