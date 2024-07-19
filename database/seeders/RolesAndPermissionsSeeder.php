<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Permissions
        $permissions = [
            'manage regions',
            'manage centres',
            'manage participants',
            'manage diplomas',
            'manage payments',
            'manage certificates',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Rôles
        $roles = [
            'super-admin',
            'admin',
            'user',
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role, 'guard_name' => 'web']);
        }

        // Assign permissions to roles
        $superAdmin = Role::where('name', 'super-admin')->first();
        $admin = Role::where('name', 'admin')->first();
        $user = Role::where('name', 'user')->first();

        $superAdmin->syncPermissions(Permission::all());
        $admin->syncPermissions(['manage centres', 'manage participants','manage diplomas','manage certificates']);
        $user->syncPermissions(['manage participants']);
    }
}
