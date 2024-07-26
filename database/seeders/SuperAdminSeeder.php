<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Créer un super admin
        $superAdmin = User::firstOrCreate([
            'email' => 'obouysfi@gmail.com'
        ], [
            'name' => 'Othman Bouysfi',
            'password' => bcrypt('OBouysfi@'),
        ]);

        // Liste des permissions à créer
        $permissions = [
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
        ];

        // Créer les permissions si elles n'existent pas
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Créer les rôles et leur assigner des permissions
        $admin1 = Role::firstOrCreate(['name' => 'admin1']);
        $admin1->syncPermissions([
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

        $admin2 = Role::firstOrCreate(['name' => 'admin2']);
        $admin2->syncPermissions([
            'add centres',
            'add participants',
            'print state',
            'print diploma',
            'print certificate',
        ]);

        // Créer le rôle super admin et lui assigner toutes les permissions
        $superAdminRole = Role::firstOrCreate(['name' => 'super-admin']);
        $superAdminRole->syncPermissions(Permission::all());

        // Assigner le rôle super admin à l'utilisateur créé
        $superAdmin->assignRole($superAdminRole);
    }
}
