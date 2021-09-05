<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsHistory extends Model
{
    use HasFactory;
    protected $table = 'sms_history';
    protected $fillable = [
        'phone',
        'msg',
        'locked',
        'incoming',
        'date',
        'user',
    ];
}
