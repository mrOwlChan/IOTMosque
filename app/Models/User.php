<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        
        'lev',
        'telp',
        'photo'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relasi dengan table userdetails (model: Userdetail)
    public function userdetail(){
        return $this->hasOne(Userdetail::class);
    }

    // Relasi dengan table publish_permissions (model: PublishPermission)
    public function publishPermission(){
        return $this->hasMany(PublishPermission::class);
    }

    // Relasi dengan table article_user_links (model: ArticleUserLink)
    public function articleUserLink(){
        return $this->hasMany(articleUserLink::class);
    }
}
