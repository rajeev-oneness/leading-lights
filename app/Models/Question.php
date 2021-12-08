<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public function optionData(){
        return $this->hasMany(QuestionOption::class);
    }

    public function exams(){
        return $this->belongsTo(ArrangeExam::class);
    }
}
