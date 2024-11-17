<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $guarded =[];
    protected $appends =['answer'];

    public function getAnswerAttribute(){
        return $this->attributes[getLanguage('answer')];
    }
}
