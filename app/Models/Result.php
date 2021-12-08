<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    public function arrange_exams(){
        return $this->belongsTo(ArrangeExam::class);
    }

    public function exams(){
        return $this->belongsTo(ArrangeExam::class);
    }
}
