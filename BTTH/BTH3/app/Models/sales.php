<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class sales extends Model
{
    protected $fillable = [
        'medicine_id',
        'quantity',
        'sale_date',
        'customer_phone',
        'created_at',
        'updated_at',
    ];
}
