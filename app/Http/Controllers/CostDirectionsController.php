<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CostDirectionsController extends Controller
{
    public function getCostDirections()
    {
        $costDirections = Auth::user()->costDirections()->get();

        foreach($costDirections as $direction){
            $direction['cost_items'] = $direction->costItems;
        }

        return response()->json([
            'costDirections' => $costDirections
        ], 200);
    }

    public function createCostDirection(Request $request)
    {
        $validated = $request->validate(['title' => 'required|min:3|max:30|cyrillic']);
        $costDirection = $request->user()->costDirections()->create($validated);

        return response()->json([
            'costDirection' => $costDirection,
            'message' => 'Новий напрямок витрат успішно доданий!'
        ], 200);
    }
}
