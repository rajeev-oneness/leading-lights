<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArrangeExam extends Model
{
    use HasFactory;

    public function result(){
        return $this->hasOne(Result::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function subject_details()
    {
        return $this->belongsTo(Subject::class,'subject','id');
    }

    public function class_details()
    {
        return $this->belongsTo(Classes::class,'class');
    }

    public function user_details()
    {
        return $this->belongsTo(User::class);
    }
}
