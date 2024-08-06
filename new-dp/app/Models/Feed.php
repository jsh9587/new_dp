<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    use HasFactory;

    protected $table = 'feeds';
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'content',
        'media_url',
        'created_at',
        'updated_at'
    ];

}
