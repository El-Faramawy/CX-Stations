<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;
    protected $guarded =[];
    protected $appends = ['is_liked','video_url','share_ad_url'];

    public function getImageAttribute()
    {
        return get_file($this->attributes['image']);
    }

    public function getVideoUrlAttribute()
    {
        return get_video_file($this->video);
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function getIsLikedAttribute(){
        if(user_api()->check()){
            $ad_like = AdLike::where(['user_id' => user_api()->id(), 'ad_id' => $this->attributes['id']])->count();
            if ($ad_like > 0){
                return true;
            }
            return false;
        }
        return false;
    }

    public function like(){
        return $this->HasMany(AdLike::class);
    }

    public function comment(){
        return $this->HasMany(AdComment::class);
    }

    public function share(){
        return $this->HasMany(AdShare::class);
    }

    public function getshareAdUrlAttribute(){
        return url('share_ad', $this->id);
    }

}
