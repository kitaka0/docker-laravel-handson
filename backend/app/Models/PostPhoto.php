<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostPhoto extends Model
{
    use HasFactory;

    /**
     * リレーション (従属)
     */
    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }
}
