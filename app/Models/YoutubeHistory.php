<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YoutubeHistory extends Model
{
    use HasFactory;
    protected $table = 'youtube_history';
    protected $fillable = [
        'channel',
        'locked',
        'user',
        'date',
    ];
}
