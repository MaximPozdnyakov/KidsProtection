<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Youtube extends Model
{
    use HasFactory;
    protected $table = 'youtube';
    protected $fillable = [
        'channel',
        'child',
        'parent',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
