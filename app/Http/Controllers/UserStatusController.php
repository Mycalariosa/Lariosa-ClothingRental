<?php

namespace App\Http\Controllers;

use App\Models\UserStatus;
use Illuminate\Http\Request;

class UserStatusController extends Controller
{
    // 📦 Get all user statuses
    public function getUserStatuses()
    {
        $statuses = UserStatus::all();
        return response()->json(['statuses' => $statuses]);
    }

    // ➕ Add new user status
    public function addUserStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|unique:user_statuses,id',
            'status' => 'required|string|max:255'
        ]);

        $status = UserStatus::create($request->all());

        return response()->json(['message' => 'User status added successfully.', 'status' => $status]);
    }

    // ✏️ Edit user status
    public function editUserStatus(Request $request, $id)
    {
        $status = UserStatus::find($id);

        if (!$status) {
            return response()->json(['message' => 'User status not found.'], 404);
        }

        $request->validate([
            'id' => 'required|integer|unique:user_statuses,id,' . $id,
            'status' => 'required|string|max:255'
        ]);

        $status->update($request->all());

        return response()->json(['message' => 'User status updated successfully.', 'status' => $status]);
    }

    // ❌ Delete user status
    public function deleteUserStatus($id)
    {
        $status = UserStatus::find($id);

        if (!$status) {
            return response()->json(['message' => 'User status not found.'], 404);
        }

        $status->delete();

        return response()->json(['message' => 'User status deleted successfully.']);
    }
}
