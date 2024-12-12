<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class issues extends Model
{
    protected $fillable = [
        'computer_id',
        'reported_by',
        'reported_date',
        'description',
        'urgency',
        'status',
        'created_at',
        'updated_at',
    ];
}
