<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $validatedUser = Validator::make($request->all(),
            [
                'password' => ['required'],
                'email' => ['email', 'required'],
            ]);

        if ($validatedUser->fails()) {
            return response()->json([
                'message' => 'validation error',
                'errors' => $validatedUser->errors()
            ], 401);
        }

        if (!Auth::attempt($request->only(['email', 'password']))) {
            return response()->json([
                'status' => false,
                'message' => 'Email & Password does not match our records.',
            ], 401);
        }

        $user = User::firstWhere('email', $request->email);

        if ($user->hasRole('admin')) {
            $token = $user->createToken('admin-token', [
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
            ])
                ->plainTextToken;
        }
        elseif ($user->hasRole('staff')) {
            $token = $user->createToken('staff-token', [
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
            ])
                ->plainTextToken;
        }
        else {
            $token = $user->createToken('user-token', [
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
            ])
                ->plainTextToken;
        }

        return response()->json([
            'message' => 'User logged in successfully',
            'token' => $token
        ], 200);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'message' => 'logged out successfully'
        ], 200);
    }
}
