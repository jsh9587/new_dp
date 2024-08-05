<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerConfig extends Model
{
    use HasFactory;

    protected $table = 'banner_configs';
    protected $fillable = [
        'title',
        'created_at',
        'updated_at'
    ];

    public function Banner(){
        return $this->hasMany(Banner::class,'banner_id','id');
    }
}
