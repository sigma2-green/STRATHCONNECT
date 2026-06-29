<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClubLeader extends Model
{
    protected $fillable = [
        'club_id',
        'student_id',
        'position',
    ];

    public function club()
    {
        return $this->belongsTo(Club::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
