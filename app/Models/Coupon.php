<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function duet(){
        return $this->belongsTo(Duet::class);
    }

    public function duet_user(){
        return $this->belongsTo(DuetUser::class);
    }

}
