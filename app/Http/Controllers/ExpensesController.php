<?php

namespace App\Http\Controllers;

use App\Models\CostItem;
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
}
