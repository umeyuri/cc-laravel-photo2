<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Comment;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'comment',
        'image',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function comments() {
        return $this->hasMany('App\Models\Comment');
    }

    // public function scopeRecommend($query) {
    //     return $query->inRandomOrder()->limit(3);
    // }

    public function scopeRecommend($query, $user_id) {
        return $query->where('user_id', $user_id)->inRandomOrder()->limit(3);
    }
}
