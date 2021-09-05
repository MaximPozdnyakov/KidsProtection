<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationHistory extends Model
{
    use HasFactory;
    protected $table = 'application_history';
    protected $fillable = [
        'package',
        'name',
        'image',
        'locked',
        'start_dt',
        'end_dt',
        'user',
    ];
}
