<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CostItem;
use Illuminate\Support\Facades\Auth;

class CostItemsController extends Controller
{
    public function getCostItems()
    {
        $costItems = Auth::user()->costItems()->get();

        return response()->json([
            'costItems' => $costItems
        ], 200);
    }

    public function createCostItem(Request $request)
    {
        $validated = $request->validate(['title' => 'required|min:3|max:30|cyrillic']);
        $costItem = $request->user()->costItems()->create($validated);

        return response()->json([
            'costItem' => $costItem,
            'message' => 'Стаття витрат успішно додана!'
        ], 200);
    }
}
