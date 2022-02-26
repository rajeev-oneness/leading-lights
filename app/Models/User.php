<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'original_password',
        'id_no',
        'dob',
        'class',
        'gender',
        'image',
        'mobile',
        'last_login_time',
        'special_course_ids',
        'country_code'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }
    public function students()
    {
        return $this->hasMany('App\Models\Group', 'group_ids', 'id');
    }

    public function class_details()
    {
        return $this->belongsTo('App\Models\Classes','class','id');
    }

    public  function group_details()
    {
        return $this->hasMany(Group::class);
    }

    public  function testimonial()
    {
        return $this->hasMany(Testimonial::class);
    }

    public  function flash_course()
    {
        return $this->belongsTo(Course::class);
    }

    public  function exam()
    {
        return $this->hasMany(ArrangeExam::class);
    }
    public  function qualification()
    {
        return $this->belongsTo(Qualification::class);
    }
    public  function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
    
}
