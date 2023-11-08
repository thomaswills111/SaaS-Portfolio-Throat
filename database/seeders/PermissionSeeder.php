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
            'add words',
            'edit words',
            'search words',
            'browse words',
            'delete words',

            'add users',
            'edit users',
            'search users',
            'browse users',
            'delete users',

            'add word types',
            'edit word types',
            'search word types',
            'browse word types',
            'delete word types',

            'add definitions',
            'edit definitions',
            'search definitions',
            'browse definitions',
            'delete definitions',

            'add ratings',
            'edit ratings',
            'search ratings',
            'browse ratings',
            'delete ratings',

            'add definition ratings',
            'edit definition ratings',
            'search definition ratings',
            'browse definition ratings',
            'delete definition ratings',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
