<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;
    protected $table = 'children';
    protected $fillable = [
        'name',
        'year',
        'parent',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
