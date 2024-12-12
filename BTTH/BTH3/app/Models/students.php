<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class students extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'date_of_birth',
        'parent_phone',
        'class_id',
        'created_at',
        'updated_at',
    ];
}
