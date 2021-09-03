<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function messages()
    {
        return $this->belongsTo(Message::class); // écriture équivalente : return $this->belongsTo('App\Models\Message');
    }

    public function users()
    {
        return $this->belongsTo(User::class); // écriture équivalente : return $this->belongsTo('App\Models\User');
    }


}
