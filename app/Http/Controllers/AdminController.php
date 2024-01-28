<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function dashboard() {
        $currentId = Auth::id();
        $users = User::where('id', '!=', $currentId )->paginate(5);
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
