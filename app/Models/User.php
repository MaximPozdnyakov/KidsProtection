<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'fio',
        'email',
        'password',
        'termsAgree',
        'emailVerified',
        'emailNotify',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'created_at',
        'updated_at',
        'remember_token',
        'avatar',
        'role_id',
        'settings',
    ];

    protected $casts = [
        'termsAgree' => 'boolean',
        'emailVerified' => 'boolean',
        'emailNotify' => 'boolean',
    ];
}
