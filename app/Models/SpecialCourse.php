<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialCourse extends Model
{
    use HasFactory;

    public function class_details()
    {
        return $this->belongsTo(Classes::class,'class_id');
    }
}
