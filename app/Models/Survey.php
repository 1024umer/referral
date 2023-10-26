<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'survey_id', 'is_active'];
    public function questions()
    {
        return $this->hasMany(SurveyQuestion::class, 'survey_id');
    }
}