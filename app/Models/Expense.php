<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CostItem;

class Expense extends Model
{
    protected $fillable = ['cost_item_id', 'sum', 'user_id'];
    public $timestamps = false;

    public function costItem()
    {
        return $this->belongsTo(CostItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
