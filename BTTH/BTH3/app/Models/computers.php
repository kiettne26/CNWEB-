<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class computers extends Model
{
    protected $fillable = [
        'computer_name',
        'model',
        'operating_system',
        'processor',
        'memory',
        'available',
        'created_at',
        'updated_at',
    ];
}
