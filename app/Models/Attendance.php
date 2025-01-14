<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model {
    
    protected $fillable = [
        'user_id', 
        'talk_id', 
        'check_in_time'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    } 

    public function talk() {
        return $this->belongsTo(Talk::class);
    }
   }