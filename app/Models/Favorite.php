<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_acc', 'id_post'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class, 'id_acc');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'id_post');
    }
    protected $table = 'favorites';
}
