<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class classes extends Model
{
    protected $fillable = [
        'grade_level',
        'room_number',
        'created_at',
        'updated_at',
    ];
}
