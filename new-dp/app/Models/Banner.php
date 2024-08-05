<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $table = 'banners';
    protected $fillable = [
        'banner_id',
        'title',
        'sub_title',
        'link',
        'image',
        'start_date',
        'end_date',
        'created_at',
        'updated_at'
    ];
    public function BannerConfig(){
        return $this->belongsTo(BannerConfig::class, 'banner_id', 'id');
    }
}
