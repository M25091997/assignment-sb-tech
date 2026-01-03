<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShortUrl extends Model
{
    protected $fillable = [
        'code',
        'original_url',
        'user_id',
        'company_id',
        'is_active',
    ];
}
