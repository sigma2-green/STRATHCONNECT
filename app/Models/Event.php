<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'location',
        'start_datetime',
        'end_datetime',
        'created_by',
        'status',
    ];
}