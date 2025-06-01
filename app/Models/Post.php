<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['likes', 'comments', 'content', 'id_account'];

    public function account()
    {
        return $this->belongsTo(Account::class, 'id_account');
    }

    protected $table = 'posts';

    public function comments()
    {
        return $this->hasMany(Comment::class, 'id_post');
    }

    public function likes(){
        return $this->likes;
    }

    public function decrementLikes()
    {
        $this->decrement('likes');
    }
    public function incrementLikes()
    {
        $this->increment('likes');
    }

    public function decrementComments()
    {
        $this->decrement('comments');
    }
    public function incrementComments()
    {
        $this->increment('comments');
    }
}