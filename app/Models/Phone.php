<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;
    protected $table = 'phones';
    protected $fillable = [
        'phone',
        'child',
        'parent',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
