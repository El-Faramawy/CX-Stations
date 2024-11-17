<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Brand extends Authenticatable
{
    use HasFactory;
    protected $guarded =[];
    protected $appends = ['is_follow'];

    public function getImageAttribute()
    {
        return get_file($this->attributes['image']);
    }

    public function getPannerAttribute()
    {
        return get_file($this->attributes['panner']);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function ads(){
        return $this->hasMany(Ad::class);
    }

    public function getIsFollowAttribute(){
        if(user_api()->check()){
            $follow = Follow::where(['user_id' => user_api()->id(), 'brand_id' => $this->attributes['id']])->count();
            if ($follow > 0){
                return true;
            }
            return false;
        }
        return false;
    }
    public function follow(){
        return $this->HasMany(Follow::class);
    }
}
