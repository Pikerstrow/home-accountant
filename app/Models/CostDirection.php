<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CostDirection extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'title',
        'has_cost_items',
        'sum'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function costItems()
    {
        return $this->hasMany(CostItem::class);
    }
}
