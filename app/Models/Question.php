<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model {

    protected $fillable = [
        'survey_id', 
        'question_text',
        'type', 
        'options'
    ];

     protected $casts = [

        'options' => 'array'
    ];

    public function survey() {

        return $this->belongsTo(Survey::class);
    }

    public function responses() {
        
        return $this->hasMany(SurveyResponse::class);
    }
   }
