<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Admin = User::create([
            'name' => 'Achraf Salki',
            'email' => 'achraf.salki@gmail.com',
            'password' => bcrypt('12345@'), 
        ]);

        $role = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);

        // $permissions = Permission::all();
        // $role->syncPermissions($permissions);

        $Admin->assignRole($role);
    }
}