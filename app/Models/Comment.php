<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'image',
        'tags',
        'user_id',
        'message_id'
    ];

    public function message()
    {
        return $this->belongsTo(Message::class); // écriture équivalente : return $this->belongsTo('App\Models\Message');
    }

    public function user()
    {
        return $this->belongsTo(User::class); // écriture équivalente : return $this->belongsTo('App\Models\User');
    }


}
