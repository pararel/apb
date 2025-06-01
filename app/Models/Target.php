<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'parameter', 'start', 'end', 'days', 
        'value', 'average', 'usage', 'countDays'
    ];

    protected $table = 'targets';
}
