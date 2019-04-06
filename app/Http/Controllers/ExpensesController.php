<?php

namespace App\Http\Controllers;

use App\Models\CostItem;
use Illuminate\Http\Request;


class ExpensesController extends Controller
{
    protected $fillable= ['sum', 'user_id', 'cost_item_id'];
    public $timestamps = false;

    public function costItem()
    {
        return $this->belongsTo(CostItem::class);
    }
}
