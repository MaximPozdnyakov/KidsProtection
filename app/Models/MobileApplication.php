<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileApplication extends Model
{
    use HasFactory;
    protected $table = 'mobile_applications';
    protected $fillable = [
        'name',
        'display_name',
        'icon_name',
        'is_blocked',
        'time_use_start',
        'time_use_end',
        'parent_id',
        'child_id',
    ];
}
