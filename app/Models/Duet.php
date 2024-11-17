<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Duet extends Model
{
    protected $guarded = [];

    public function brand1()
    {
        return $this->belongsTo(Brand::class);
    }

    public function brand2()
    {
        return $this->belongsTo(Brand::class);
    }
}
