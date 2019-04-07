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
        $expensesWithDirections = [];

        $today = Carbon::today();
//        $expenses = Auth::user()->expenses()->whereRaw("Date(date) = '{$today}'")->get();
        $costItems = Auth::user()->costItems;

        foreach($costItems as $item){
            $expenses = $item->expenses()->whereRaw("Date(date) = '{$today}'")->get();
            $direction = $item->costDirection;

            $expensesWithDirections[$direction->title][$item->title] = $expenses;
        }

//        foreach($expenses as $expense){
//
//            if(!$expense->costItem){
//                $direction = $expense->costDirection()->get();
//                $expensesWithDirections[$direction->title]['-'] = $expense;
//            } else {
//                $costItem = $expense->costItem()->get();
//                $direction = $costItem->costDirection()->get();
//
//                $expensesWithDirections[$direction->title][$costItem->title] = $expense;
//
//            }
//        }




        return response()->json([$expensesWithDirections]);
    }
}
