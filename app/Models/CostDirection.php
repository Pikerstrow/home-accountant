<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CostDirection extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'title'
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
