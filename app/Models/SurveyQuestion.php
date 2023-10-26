<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyQuestion extends Model
{
    use HasFactory;
    protected $with = ['survey'];
    protected $fillable = ['survey_id', 'sortOrder', 'question'];
    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }
    public function answers()
    {
        return $this->hasMany(SurveyQuestionAnswer::class, 'survey_question_id');
    }
}