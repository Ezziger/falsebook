<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
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
     * @var string[]
     */
    protected $fillable = [
        'prenom',
        'nom',
        'pseudonyme',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles ()
    {
        return $this->belongsTo(Role::class); // écriture équivalente : return $this->belongsTo('App\Models\Role');
    }

    public function messages()
    {
        return $this->hasMany(Message::class); // écriture équivalente : return $this->hasMany('App\Models\Message');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class); // écriture équivalente : return $this->hasMany('App\Models\Comment');
    }

}

