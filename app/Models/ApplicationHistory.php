<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationHistory extends Model
{
    use HasFactory;
    protected $table = 'application_history';
    protected $fillable = [
        'app',
        'day',
        'time',
        'user',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
