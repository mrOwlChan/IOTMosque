<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleUserLink extends Model
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
