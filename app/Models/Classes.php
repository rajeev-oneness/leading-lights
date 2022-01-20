<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;
    protected $table = 'classes';

    public function users()
    {
        return $this->hasOne(User::class);
    }

    public function course_details()
    {
        return $this->hasOne(SpecialCourse::class);
    }

    public function exam()
    {
        return $this->hasMany(ArrangeExam::class);
    }
}
