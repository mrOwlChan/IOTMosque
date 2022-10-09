<?php

namespace App\Models;

use App\Models\User;
use App\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Author extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi dengan table users (model: User)
    public function user(){
        return $this->belongsTo(User::class);
    }

    // Relasi dengan table articles (model: Article)
    public function article(){
        return $this->belongsTo(Article::class);
    }
}
