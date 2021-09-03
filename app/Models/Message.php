<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    public function comments()
    {
        return $this->hasMany(Comment::class); // écriture équivalente : return $this->hasMany('App\Models\Comment');
    }

    public function users()
    {
        return $this->belongsTo(User::class); // écriture équivalente : return $this->belongsTo('App\Models\User');
    }

}
