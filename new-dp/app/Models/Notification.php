<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications';

    protected $fillable = [
      'user_id',
      'type',
      'reference_id',
      'read_at',
      'created_at',
      'updated_at'
    ];
}
