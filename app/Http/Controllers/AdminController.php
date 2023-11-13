<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function dashboard() {
        $users = User::paginate(5);
        $roles = Role::all();
        return view('admin.dashboard', compact(['users', 'roles']));
    }

    public function updateRole(Request $request, User $user) {
        $newRole = $request["role"];
        $user->roles()->detach();
        $user->assignRole($newRole);

        return redirect(route('admin.dashboard'))
            ->with('updated', $user->name)
            ->with('messageType', ['updated', true]);

    }

}
