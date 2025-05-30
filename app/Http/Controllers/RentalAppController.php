<?php

namespace App\Http\Controllers;

use App\Models\RentalApp;
use Illuminate\Http\Request;

class RentalAppController extends Controller
{
    // 📦 Get all rentals
    public function getRentals()
    {
        $rentals = RentalApp::with('user', 'clothes', 'rentalStatus')->get();
        return response()->json(['rentals' => $rentals]);
    }

    // ➕ Create new rental
    public function addRental(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'clothes_id' => 'required|exists:clothes,clothes_id',
            'rental_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:rental_date',
            'payment_method' => 'required|string|max:100',
            'total_payment' => 'required|numeric|min:0',
            // 'rental_status_id' => 'required|exists:rental_stats,rental_id', // Make optional
        ]);

        $data = $request->all();
        if (!isset($data['rental_status_id'])) {
            $pendingStatus = \App\Models\RentalStat::where('rental_status', 'pending')->first();
            if (!$pendingStatus) {
                return response()->json(['message' => 'Pending rental status not found.'], 422);
            }
            $data['rental_status_id'] = $pendingStatus->rental_id;
        }

        $rental = RentalApp::create($data);

        return response()->json(['message' => 'Rental created successfully.', 'rental' => $rental]);
    }

    // ✏️ Edit rental
    public function editRental(Request $request, $id)
    {
        $rental = RentalApp::find($id);

        if (!$rental) {
            return response()->json(['message' => 'Rental not found.'], 404);
        }

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'clothes_id' => 'required|exists:clothes,id',
            'rental_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:rental_date',
            'payment_method' => 'required|string|max:100',
            'total_payment' => 'required|numeric|min:0',
            'rental_status_id' => 'required|exists:rental_stats,id',
        ]);

        $rental->update($request->all());

        return response()->json(['message' => 'Rental updated successfully.', 'rental' => $rental]);
    }

    // ❌ Delete rental
    public function deleteRental($id)
    {
        $rental = RentalApp::find($id);

        if (!$rental) {
            return response()->json(['message' => 'Rental not found.'], 404);
        }

        $rental->delete();

        return response()->json(['message' => 'Rental deleted successfully.']);
    }
}
