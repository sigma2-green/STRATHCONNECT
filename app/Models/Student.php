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
        'year_level',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function groups()
{
    return $this->belongsToMany(Group::class, 'group_student');
}

}
