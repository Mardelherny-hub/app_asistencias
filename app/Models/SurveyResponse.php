<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyResponse extends Model {
    protected $fillable = [
        'survey_id', 
        'user_id',
        'question_id',
        'response'
    ];

    public function survey() {

        return $this->belongsTo(Survey::class);
    }

    public function user() {

        return $this->belongsTo(User::class);
    }

    public function question() {
        
        return $this->belongsTo(Question::class);
    }
    
   }
