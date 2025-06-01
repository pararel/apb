<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Account extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'all_targets',
        'current_targets',
        'likes',
        'posts',
        'post_liked',
        'picture',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $table = 'accounts';

    public function incrementPosts()
    {
        $this->increment('posts');
    }
    public function decrementPosts()
    {
        $this->decrement('posts');
    }
    public function incrementCurrentTargets()
    {
        $this->increment('current_targets');
    }
    public function decrementCurrentTargets()
    {
        $this->decrement('current_targets');
    }
    public function incrementAllTargets()
    {
        $this->increment('all_targets');
    }
    public function decrementLikes()
    {
        $this->decrement('likes');
    }
    public function incrementLikes()
    {
        $this->increment('likes');
    }

    public function incrementPostLiked($amount = 1)
    {
        $this->increment('post_liked', $amount);
    }
    public function decrementPostLiked($amount = 1)
    {
        $this->decrement('post_liked', $amount);
    }
}
