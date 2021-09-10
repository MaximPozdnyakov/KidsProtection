<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;
    protected $table = 'sites';
    protected $fillable = [
        'site',
        'child',
        'parent',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
