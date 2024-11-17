<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $guarded =[];
    protected $appends =['question'];

    public function getQuestionAttribute(){
        return $this->attributes[getLanguage('question')];
    }

    public function question_answers(){
        return $this->hasMany(QuestionAnswer::class);
    }

    public function userAnswers(){
        return $this->hasMany(UserAnswer::class);
    }

    public function answers(){
        return $this->belongsToMany(Answer::class, 'question_answers', 'question_id', 'answer_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
