<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    protected $table = 'applications';
    protected $fillable = [
        'package',
        'name',
        'image',
        'locked',
        'start_dt',
        'end_dt',
        'parent',
        'user',
    ];
}
