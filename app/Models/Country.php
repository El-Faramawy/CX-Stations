<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $guarded = [];
    protected $appends =['name'];

    public function getNameAttribute(){
        return $this->attributes[getLanguage('name')];
    }
}
