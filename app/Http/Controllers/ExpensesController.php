<?php

namespace App\Http\Controllers;

use App\Models\CostItem;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;


class ExpensesController extends Controller
{
    // Returns current dya expenses
    public function index()
    {
        $today = Carbon::today();

        $expenses = Auth::user()->expenses()
                                ->with('costItem:id,title', 'costDirection:id,title')
                                ->whereRaw("Date(date) = '{$today}'")->get();

        return response()->json([
            'currentDayExpenses' => $expenses
        ], 200);
    }

    public function createExpense(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date|date_format:d-m-Y',
            'cost_item_id' => 'required|integer',
            'cost_direction_id' => 'required|integer',
            'sum' => 'required|numeric'
        ]);

        $validated['date'] = Carbon::createFromFormat('d-m-Y', $request->get('date'))->toDateTimeString();

        $expense_id = $request->user()->expenses()->create($validated)->id;

        $expense = Auth::user()->expenses()
                                ->with('costItem:id,title', 'costDirection:id,title')
                                ->where("id", $expense_id)->get();

        return response()->json([
            'expense' => $expense,
            'message' => 'Витрата успішно додана!'
        ], 200);
    }
}
