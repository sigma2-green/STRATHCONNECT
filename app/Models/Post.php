<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'student_id',
        'lecturer_id',
        'group_id',
        'content',
        'attachment',
        'attachment_type',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function comments()
{
    return $this->hasMany(Comment::class)
        ->whereNull('parent_id');
}

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    public function hasAttachment()
    {
        return !empty($this->attachment);
    }

    public function isImage()
    {
        return $this->attachment_type === 'image';
    }

    public function isPdf()
    {
        return $this->attachment_type === 'pdf';
    }

    public function isWord()
    {
        return in_array($this->attachment_type, ['doc', 'docx']);
    }

    public function isPowerPoint()
    {
        return in_array($this->attachment_type, ['ppt', 'pptx']);
    }

    public function isVideo()
    {
        return $this->attachment_type === 'video';
    }
}