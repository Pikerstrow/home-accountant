<?php

namespace App\Http\Controllers;

use App\Models\CostDirection;
use Illuminate\Http\Request;
use App\Models\CostItem;
use Illuminate\Support\Facades\Auth;


class CostItemsController extends Controller
{
    public function createCostItem(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|min:4|max:30',
            'cost_direction_id' => 'required'
        ]);

        $costItem = CostItem::create($validated);

        return response()->json([
            'costItem' => $costItem,
            'message' => 'Елемент витрат успішно доданий!'
        ], 200);


    }
}
