<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Crear permisos
        $permissions = [
            'manage events',
            'create events',
            'edit events',
            'delete events',
            'manage talks',
            'create talks',
            'edit talks',
            'delete talks',
            'view reports',
            'manage surveys',
            'respond surveys',
            'manage users',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Crear roles y asignar permisos
        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'event-manager']);
        $role->givePermissionTo([
            'manage events',
            'create events',
            'edit events',
            'delete events',
            'manage talks',
            'create talks',
            'edit talks',
            'delete talks',
            'view reports',
            'manage surveys',
        ]);

        $role = Role::create(['name' => 'participant']);
        $role->givePermissionTo([
            'respond surveys',
        ]);
    }
}