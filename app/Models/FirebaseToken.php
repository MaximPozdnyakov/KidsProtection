<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FirebaseToken extends Model
{
    use HasFactory;
    protected $table = 'firebase_tokens';
    protected $fillable = [
        'token',
        'user',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
