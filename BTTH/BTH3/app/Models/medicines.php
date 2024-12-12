<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class medicines extends Model
{
    protected $fillable = [
        'name',
        'brand',
        'dosage',
        'form',
        'price',
        'stock',
    ];
}
