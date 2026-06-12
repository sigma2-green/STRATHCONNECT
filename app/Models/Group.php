<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Group extends Model
{
    protected $fillable = [
        'name',
        'type',
        'school',
        'course',
        'year_level',
        'student_group',
    ];

    public function students()
{
    return $this->belongsToMany(Student::class, 'group_student');
}
}