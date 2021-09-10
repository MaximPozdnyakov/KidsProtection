<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallSmsHistory extends Model
{
    use HasFactory;
    protected $table = 'call_sms_history';
    protected $fillable = [
        'phone',
        'input',
        'isCall',
        'message',
        'date',
        'child',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
