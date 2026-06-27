<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    protected $fillable = [
    'name',
    'description',
    'category',
    'logo',
    'banner',
    'status',
    'created_by_student_id',
    'created_by_lecturer_id',
];

    public function members()
    {
        return $this->belongsToMany(
            Student::class,
            'club_student'
        );
    }

    public function leaders()
    {
        return $this->hasMany(ClubLeader::class);
    }

   public function creatorStudent()
{
    return $this->belongsTo(Student::class, 'created_by_student_id');
}

public function creatorLecturer()
{
    return $this->belongsTo(Lecturer::class, 'created_by_lecturer_id');
}
public function lecturers()
{
    return $this->belongsToMany(
        Lecturer::class,
        'club_lecturer'
    );
}
}