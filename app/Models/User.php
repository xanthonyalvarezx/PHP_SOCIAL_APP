<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Dom\Attr;
use App\Models\Follow;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id');
    }
    public function followers()
    {
        return $this->hasMany(Follow::class, 'followed_user');
    }
    public function following()
    {
        return $this->hasMany(Follow::class, 'user_id');
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];
    protected function photo(): Attribute
    {
        return Attribute::make(get: function ($value) {
            return $value ? "/storage/profilePhotos/$value" : '/fallback-photo.jpg';
        });
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
