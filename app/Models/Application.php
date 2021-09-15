<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    protected $table = 'applications';
    protected $fillable = [
        'pack',
        'name',
        'icon',
        'limit',
        'from',
        'to',
        'parent',
        'user',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
