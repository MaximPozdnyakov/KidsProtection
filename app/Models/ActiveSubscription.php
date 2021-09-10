<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActiveSubscription extends Model
{
    use HasFactory;
    protected $table = 'active_subscriptions';
    protected $fillable = [
        'subscribe',
        'fromDate',
        'endDate',
        'user',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
