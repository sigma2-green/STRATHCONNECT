<?php
 
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'username',
        'email',
        'student_number',
        'school',
        'course',
        'group',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
