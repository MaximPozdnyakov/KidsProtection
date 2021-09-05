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
        'locked',
        'start_dt',
        'end_dt',
        'user',
        'parent',
    ];
}
