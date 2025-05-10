<?php

namespace App\Http\Controllers;

use App\Models\Clothes;
use Illuminate\Http\Request;

class ClothesController extends Controller
{
    // 📦 Get all clothes
    public function getClothes()
    {
        $clothes = Clothes::all();
        return response()->json(['clothes' => $clothes]);
    }

    // ➕ Add new clothing item
    public function addClothes(Request $request)
    {
        $request->validate([
            'brand' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'size' => 'required|string|max:50',
            'price' => 'required|numeric|min:0',
            'color' => 'required|string|max:50',
            'material' => 'required|string|max:100',
            'description' => 'nullable|string|max:1000',
        ]);

        $clothes = Clothes::create($request->all());

        return response()->json(['message' => 'Clothing item added successfully.', 'clothes' => $clothes]);
    }

    // ✏️ Edit existing clothing item
    public function editClothes(Request $request, $id)
    {
        $clothes = Clothes::find($id);

        if (!$clothes) {
            return response()->json(['message' => 'Clothing item not found.'], 404);
        }

        $request->validate([
            'brand' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'size' => 'required|string|max:50',
            'price' => 'required|numeric|min:0',
            'color' => 'required|string|max:50',
            'material' => 'required|string|max:100',
            'description' => 'nullable|string|max:1000',
        ]);

        $clothes->update($request->all());

        return response()->json(['message' => 'Clothing item updated successfully.', 'clothes' => $clothes]);
    }

    // ❌ Delete clothing item
    public function deleteClothes($id)
    {
        $clothes = Clothes::find($id);

        if (!$clothes) {
            return response()->json(['message' => 'Clothing item not found.'], 404);
        }

        $clothes->delete();

        return response()->json(['message' => 'Clothing item deleted successfully.']);
    }
}
