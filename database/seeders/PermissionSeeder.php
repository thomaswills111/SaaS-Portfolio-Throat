<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'create words',
            'edit words',
            'delete words',
            'create definitions',
            'edit definitions',
            'delete definitions',
            'create wordTypes',
            'edit wordTypes',
            'delete wordTypes',
            'create ratings',

            'edit users',
            'ban users',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
