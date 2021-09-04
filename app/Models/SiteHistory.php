<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteHistory extends Model
{
    use HasFactory;
    protected $table = 'site_history';
    protected $fillable = [
        'host',
        'locked',
        'user',
        'date',
    ];
}
