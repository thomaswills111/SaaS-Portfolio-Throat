<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $seedUsers = [
            [
                'name' => 'user',
                'email' => 'user@user.com',
                'password' => 'password',
            ],
            [
                'name' => 'STUDENT_GIVEN_NAME',
                'email' => 'STUDENT_GIVEN_NAME@example.com',
                'email_verified_at' => now(),
                'password' => 'Secret1',
            ],
            [
                'name' => 'Annie Wun',
                'email' => 'annie.wun@example.com',
                'password' => 'Password1',
            ],
            [
                'name' => 'Andy Mann',
                'email' => 'andy.mann@example.com',
                'password' => 'Password1',
            ],
        ];

        foreach ($seedUsers as $newUser) {
            $newUser['password'] = Hash::make($newUser['password']);
            $user = User::create([
                'name' => $newUser['name'],
                'email' => $newUser['email'],
                'password' => $newUser['password'],
            ])->assignRole('user');

            //            foreach ($newUser['roles'] as $role) {
            //                $newRole = Role::whereName($role)->first();
            //                if (!is_null($newRole)) {
            //                    $permissions = Permission::pluck('id', 'id')->all();
            //                    $newRole->syncPermissions($permissions);
            //                    $user->assignRole([$newRole->id]);
            //                }
            //            }
        }

    }
}
