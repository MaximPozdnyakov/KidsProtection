<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationStatistics extends Model
{
    use HasFactory;
    protected $table = 'application_statistics';
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
