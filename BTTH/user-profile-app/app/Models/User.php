<?php

namespace App\Models;

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Các trường được phép gán giá trị (Mass Assignment).
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'bio',       
        'avatar',    
    ];

    /**
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}