<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
}
    protected $fillable = [
        'title',
        'description',
        'location',
        'banner',
        'start_datetime',
        'end_datetime',
        'capacity',
        'visibility',
        'status',
        'created_by_student_id',
        'created_by_lecturer_id',
    ];
    protected $casts = [
    'start_datetime' => 'datetime',
    'end_datetime' => 'datetime',
];

    public function creatorStudent()
    {
        return $this->belongsTo(Student::class, 'created_by_student_id');
    }

    public function creatorLecturer()
    {
        return $this->belongsTo(Lecturer::class, 'created_by_lecturer_id');
    }

    public function attendees()
    {
        return $this->belongsToMany(
            Student::class,
            'event_student'
        );
    }

    public function lecturers()
    {
        return $this->belongsToMany(
            Lecturer::class,
            'event_lecturer'
        );
    }
}
