<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Lecturer extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'staff_number',
        'school',
        'course',
        'phone',
        'office',
        'approved',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function groups()
{
    return $this->belongsToMany(
        Group::class,
        'group_lecturer',
        'lecturer_id',
        'group_id'
    );
}

public function posts()
{
    return $this->hasMany(Post::class);
}

public function comments()
{
    return $this->hasMany(Comment::class);

}

public function events()
{
    return $this->belongsToMany(
        Event::class,
        'event_lecturer',
        'lecturer_id',
        'event_id'
    );
}

public function classes()
{
    return $this->belongsToMany(
        Group::class,
        'group_lecturer',
        'lecturer_id',
        'class_group_id'
    );

}

public function announcements()
{
    return $this->hasMany(Announcement::class);

}
 public function isApproved()
{
    return $this->approved; 
}
}