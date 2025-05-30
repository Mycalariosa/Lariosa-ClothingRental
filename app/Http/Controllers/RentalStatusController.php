<?php

namespace App\Http\Controllers;

use App\Models\RentalStat;
use Illuminate\Http\Request;

class RentalStatusController extends Controller
{
    // 📦 Get all rental statuses
    public function getRentalStatuses()
    {
        $statuses = RentalStat::all();
        return response()->json(['statuses' => $statuses]);
    }

    // ➕ Add new rental status
    public function addRentalStatus(Request $request)
    {
        $request->validate([
            'rental_status' => 'required|string|in:pending,rented,confirmed,complete,cancel',
        ]);

        $status = RentalStat::create($request->all());

        return response()->json(['message' => 'Rental status added successfully.', 'status' => $status]);
    }

    // ✏️ Edit rental status
    public function editRentalStatus(Request $request, $id)
    {
        $status = RentalStat::find($id);

        if (!$status) {
            return response()->json(['message' => 'Rental status not found.'], 404);
        }

        $request->validate([
            'rental_status' => 'required|string|in:pending,rented,confirmed,complete,cancel',
        ]);

        $status->update($request->all());

        return response()->json(['message' => 'Rental status updated successfully.', 'status' => $status]);
    }

    // ❌ Delete rental status
    public function deleteRentalStatus($id)
    {
        $status = RentalStat::find($id);

        if (!$status) {
            return response()->json(['message' => 'Rental status not found.'], 404);
        }

        $status->delete();

        return response()->json(['message' => 'Rental status deleted successfully.']);
    }
}

