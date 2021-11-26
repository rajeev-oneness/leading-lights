<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chatting extends Model
{
    use HasFactory, SoftDeletes;

    public function sender_details()
    {
        return $this->belongsTo('App\Models\User','senderId','id');
    }
}
