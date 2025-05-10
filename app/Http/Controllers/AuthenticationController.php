<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    // ✅ User Registration
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name'         => 'required|string|max:255',
            'last_name'          => 'required|string|max:255',
            'user_contact_number'=> 'required|string|max:20',
            'email'              => 'required|email|unique:users,email',
            'password'           => 'required|string|min:8',
            'role_id'            => 'required|integer',
            'user_status_id'     => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'first_name'          => $request->first_name,
            'last_name'           => $request->last_name,
            'user_contact_number' => $request->user_contact_number,
            'email'               => $request->email,
            'password'            => Hash::make($request->password),
            'role_id'             => $request->role_id,
            'user_status_id'      => $request->user_status_id,
        ]);

        return response()->json([
            'message' => 'User registered successfully!',
            'user'    => $user->makeHidden(['password']),
        ], 201);
    }

    // ✅ User Login
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid email or password.'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'User logged in successfully!',
            'user'    => $user->makeHidden(['password']),
            'token'   => $token,
        ]);
    }

    // ✅ User Logout
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'User logged out successfully.']);
    }
}
