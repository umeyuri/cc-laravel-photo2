<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile',
        'image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts() {
        return $this->hasMany('App\Models\Post');
    }

    public function likes() {//中間テーブルと1対多の関係
        return $this->hasMany('App\Models\Like');
    }

    public function likePosts() {//中間テーブルを介してpostテーブルと多対多の関係
        return $this->belongsToMany('App\Models\Post', 'likes'); //自分がuser_id 相手がpost_id
    }

    public function scopeRecommend($query, $user_id) { //第二引数に書くことで使える
        return $query->where('id', '!=' ,$user_id)->limit(10);
    }

    public function follows() { //中間テーブル
        return $this->hasMany('App\Models\Follow');
    }

    public function follow_users() {
        return $this->belongsToMany('App\Models\User', 'follows', 'user_id', 'follow_id');
    }

    public function followers() {
        return $this->belongsToMany('App\Models\User', 'follows', 'follow_id', 'user_id');
    }

    //自分がフォローしているかどうか
    public function isFollowing($user) {
        return $this->follow_users()->where('follow_id', $user->id)->exists();
    }
}
