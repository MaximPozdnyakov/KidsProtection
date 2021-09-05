<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportAppeal extends Model
{
    use HasFactory;
    protected $table = 'support_appeals';
    protected $fillable = [
        'theme',
        'description',
        'date',
        'user',
    ];
}
