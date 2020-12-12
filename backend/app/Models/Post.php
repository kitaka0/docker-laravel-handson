<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

	/**
     * リレーション（1対多）
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    /**
     * リレーション（1対多）
     */
    public function photos()
    {
        return $this->hasMany('App\Models\PostPhotos');
    }
    
    /**
     * リレーション (従属)
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
