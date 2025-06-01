<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $table = 'histories';

    protected $fillable = [
        'message', 'info', 'id_acc', 'id_post', 'id_target', 'id_fb'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class, 'id_acc');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'id_post');
    }

    public function target()
    {
        return $this->belongsTo(Target::class, 'id_target');
    }

    public function feedback()
    {
        return $this->belongsTo(Feedback::class, 'id_fb');
    }
}