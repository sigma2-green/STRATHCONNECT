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
    'created_by',
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

   public function creator()
{
    return $this->belongsTo(Student::class, 'created_by');
}
}