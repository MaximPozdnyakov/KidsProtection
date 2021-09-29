<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;
    protected $table = 'devices';
    protected $fillable = [
        'child',
        'parent',
        'deviceId',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
