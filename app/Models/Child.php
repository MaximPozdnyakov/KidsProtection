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
        'date',
        'parent',
        'block_all_apps',
        'block_all_phones',
        'block_all_site',
        'block_all_youtube',
    ];
}
