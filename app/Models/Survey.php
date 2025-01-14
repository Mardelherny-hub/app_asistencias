<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model {

    protected $fillable = [
        'title', 
        'talk_id'
    ];

    public function talk() {

        return $this->belongsTo(Talk::class);
    }

    public function questions() {

        return $this->hasMany(Question::class);
    }

    public function responses() {
        
        return $this->hasMany(SurveyResponse::class);
    }
   }
