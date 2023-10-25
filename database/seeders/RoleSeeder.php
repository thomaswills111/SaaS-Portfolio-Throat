<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $allPermissions = Permission::all();

        $userPermissionsList = [
            'create words',
            'edit words',
            'delete words',
            'create definitions',
            'edit definitions',
            'delete definitions',
            'create wordTypes',
            'edit wordTypes',
            'delete wordTypes',
        ];

        $userPermissions = Array();
        foreach ($userPermissionsList as $permission) {
            $userPermissions[] = Permission::query()->where('name', $permission)->first()->id;
        }

        $adminRole = Role::create(['name'=>'admin']);
        $userRole = Role::create(['name'=>'user']);

        $adminRole->syncPermissions($allPermissions);

        $userRole->syncPermissions($userPermissions);

    }
}
