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
        $users = User::with('role', 'userStatus')->get(); // Fetch users with relationships
        return response()->json(['data' => $users], 200); // Return users as JSON
    }

    // ➕ Add a new user
    public function addUser(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'user_contact_number' => 'required|digits:11', // Ensure exactly 11 digits
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        // Assign default role_id and user_status_id if not provided
        $roleId = $request->input('role_id', 2); // Default to 'Customer' role
        $userStatusId = $request->input('user_status_id', 1); // Default to 'Active' status

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'user_contact_number' => $request->user_contact_number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $roleId,
            'user_status_id' => $userStatusId,
        ]);

        return response()->json(['message' => 'User successfully created!', 'data' => $user], 201);
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
            'user_contact_number' => 'required|digits:11', // Ensure exactly 11 digits
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

        return response()->json(['message' => 'User updated successfully.', 'data' => $user], 200);
    }

    // ❌ Delete user
    public function deleteUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully.'], 200);
    }
}
