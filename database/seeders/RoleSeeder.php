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
            'edit words',
            'search words',
            'browse words',
            'delete words',

            'edit definitions',
            'search definitions',
            'browse definitions',
            'delete definitions',
            'add definitions',

            'add definition ratings',
            'edit definition ratings',
            'search definition ratings',
            'browse definition ratings',
            'delete definition ratings',
        ];

        $staffPermissionList = [
            'add words',
            'edit words',
            'search words',
            'browse words',
            'delete words',

            'add users',
            'edit users',
            'search users',
            'browse users',

            'add definitions',
            'edit definitions',
            'search definitions',
            'browse definitions',
            'delete definitions',

            'add definition ratings',
            'edit definition ratings',
            'search definition ratings',
            'browse definition ratings',
            'delete definition ratings',
        ];

        $userPermissions = Array();
        foreach ($userPermissionsList as $permission) {
            $userPermissions[] = Permission::query()->where('name', $permission)->first()->id;
        }

        $staffPermissions = Array();
        foreach ($staffPermissionList as $permission) {
            $staffPermissions[] = Permission::query()->where('name', $permission)->first()->id;
        }

        $adminRole = Role::create(['name'=>'admin']);
        $staffRole = Role::create(['name'=>'staff']);
        $userRole = Role::create(['name'=>'user']);

        $adminRole->syncPermissions($allPermissions);

        $staffRole->syncPermissions($staffPermissions);

        $userRole->syncPermissions($userPermissions);

    }
}
