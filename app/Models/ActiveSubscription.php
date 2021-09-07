<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActiveSubscription extends Model
{
    use HasFactory;
    protected $table = 'active_subscriptions';
    protected $fillable = [
        'name',
        'price',
        'free_month',
        'start_dt',
        'end_dt',
        'user',
    ];
}
