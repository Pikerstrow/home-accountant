<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CostItem;

class Expense extends Model
{
    protected $fillable = ['cost_item_id', 'sum'];
    public $timestamps = false;

    public function costItem()
    {
        return $this->belongsTo(CostItem::class);
    }

}
