<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CostItem extends Model
{
    protected $fillable= ['title', 'user_id'];
    public $timestamps = false;

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function costDirection()
    {
        return $this->belongsTo(CostDirection::class);
    }

}
