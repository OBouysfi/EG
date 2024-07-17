<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = User::create([
            'name' => 'Othman Bouysfi',
            'email' => 'obouysfi@gmail.com',
            'password' => bcrypt('OBouysfi@'), 
        ]);

        $role = Role::firstOrCreate(['name' => 'super-admin', 'guard_name' => 'web']);

        // $permissions = Permission::all();
        // $role->syncPermissions($permissions);

        $superAdmin->assignRole($role);
    }
}
