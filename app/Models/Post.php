<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'body',
        'title',
        'excerpt',
        'user_id',
        'category'
    ];

    public function author(){
        return $this->belongsTo(User::class, 'user_id'); //select * from user where project_id = 1
    }
}
