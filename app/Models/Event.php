<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = 'events';

    public function group()
    {
        return $this->belongsTo('App\Models\Group', 'group_id', 'id');
    }
}
