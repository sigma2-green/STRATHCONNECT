<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Lecturer extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'username',
        'email',
        'staff_number',
        'school',
        'department',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
