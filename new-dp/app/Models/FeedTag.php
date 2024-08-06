<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedTag extends Model
{
    use HasFactory;
    protected $table = 'feed_tag';
    protected $fillable = [
      'feed_id',
      'tag_id',
      'created_at',
      'updated_at'
    ];
}
