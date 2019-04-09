<?php

namespace App\Http\Controllers;

use App\Models\CostDirection;
use App\Models\CostItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CostDirectionsController extends Controller
{
    public function getCostDirections()
    {
        $costDirections = Auth::user()->costDirections()->with('costItems')->get();

        return response()->json([
            'costDirections' => $costDirections
        ], 200);
    }


    public function createCostDirection(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:3|max:30|cyrillic',
            'has_cost_items' => 'required|boolean'
        ]);

        $costDirection = $request->user()->costDirections()->create($validated);

        if(!$validated['has_cost_items']){

            CostItem::create([
                'title' => '-',
                'cost_direction_id' => $costDirection->id
            ]);

        }

        return response()->json([
            'costDirection' => $costDirection,
            'message' => 'Стаття витрат успішно доданий!'
        ], 200);
    }


    public function updateHasCostItemsProperty(Request $request)
    {

        $costDirection = CostDirection::findOrFail($request->get('id'));

        $validated = $request->validate([
            'has_cost_items' => 'required|boolean'
        ]);

        if($costDirection->update($validated)){
            return response()->json([
                'updated' => true
            ]);
        } else {
            return response()->json([
                'false' => true
            ]);
        }
    }

}
