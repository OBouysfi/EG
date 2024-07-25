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

        // Créer les permissions
        Permission::create(['name' => 'add regions']);
        Permission::create(['name' => 'delete regions']);
        Permission::create(['name' => 'add centres']);
        Permission::create(['name' => 'delete centres']);
        Permission::create(['name' => 'add participants']);
        Permission::create(['name' => 'add payments']);
        Permission::create(['name' => 'edit payments']);
        Permission::create(['name' => 'edit participants']);
        Permission::create(['name' => 'print state']);
        Permission::create(['name' => 'print diploma']);
        Permission::create(['name' => 'print certificate']);

        // Créer les rôles et leur assigner des permissions
        $admin1 = Role::create(['name' => 'admin1']);
        $admin1->givePermissionTo([
            'add regions',
            'delete regions',
            'add centres',
            'delete centres',
            'add participants',
            'add payments',
            'edit payments',
            'edit participants',
            'print state',
            'print diploma',
            'print certificate',
        ]);

        $admin2 = Role::create(['name' => 'admin2']);
        $admin2->givePermissionTo([
            'add centres',
            'add participants',
            'print state',
            'print diploma',
            'print certificate',
        ]);
    }
}
