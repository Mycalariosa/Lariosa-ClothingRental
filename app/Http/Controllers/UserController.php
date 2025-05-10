<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // ✅ Get all users with their roles and statuses
    public function getUsers()
    {
        $users = User::with('role', 'userStatus')->get();
        return response()->json(['users' => $users]);
    }

    // ➕ Add a new user
    public function addUser(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'user_contact_number' => 'required|string|max:20',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'role_id' => 'required|exists:roles,id',
            'user_status_id' => 'required|exists:user_statuses,id',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'user_contact_number' => $request->user_contact_number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'user_status_id' => $request->user_status_id,
        ]);

        return response()->json(['message' => 'User successfully created!', 'user' => $user]);
    }

    // ✏️ Edit an existing user
    public function editUser(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'user_contact_number' => 'required|string|max:20',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'role_id' => 'required|exists:roles,id',
            'user_status_id' => 'required|exists:user_statuses,id',
        ]);

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'user_contact_number' => $request->user_contact_number,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'user_status_id' => $request->user_status_id,
        ]);

        return response()->json(['message' => 'User updated successfully.', 'user' => $user]);
    }

    // ❌ Delete user
    public function deleteUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully.']);
    }
}
