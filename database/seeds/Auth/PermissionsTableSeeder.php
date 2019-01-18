<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create permission for each admin route
        foreach (Route::getRoutes() as $r) {
            $name = $r->getName();
            if (0 === stripos($name, 'admin.')) {
                Permission::firstOrCreate(compact('name'));
            }
        }
        // Give all permissions to administrator role
        Role::find(1)->givePermissionTo(Permission::all());
    }
}
