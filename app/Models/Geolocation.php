<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Geolocation extends Model
{
    use HasFactory;
    protected $table = 'geolocation';
    protected $fillable = [
        'latitude',
        'longitude',
        'address',
        'date',
        'child',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
