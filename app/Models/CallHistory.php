<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallHistory extends Model
{
    use HasFactory;
    protected $table = 'call_history';
    protected $fillable = [
        'phone',
        'locked',
        'incoming',
        'date',
        'user',
    ];
}
