<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNickName extends Model
{
    use HasFactory;

    protected $table = 'users_nick_name';
    protected $fillable = [
        'user_id',
        'name',
        'updated_at',
        'created_at'
    ];

    public function User(){
        return $this->hasOne(User::class, 'user_id', 'id');
    }
}
