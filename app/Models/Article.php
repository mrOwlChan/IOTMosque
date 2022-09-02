<?php

namespace App\Models;

use App\Models\ArticleUserLink;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// eloquent sluggable
use Cviebrock\EloquentSluggable\Sluggable;

class Article extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi dengan table categories (model: Category)
    public function category(){
        return $this->belongsTo(Category::class);
    }

    // Relasi dengan table article_user_links (model: ArticleUserLink)
    public function articleUserLink(){
        return $this->hasMany(ArticleUserLink::class);
    }

    // Relasi dengan table publish_permissions (model: PublishPermission)
    public function publishPermission(){
        return $this->hasMany(PublishPermission::class);
    }

    // eloquent sluggable
    use Sluggable;
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }// /.eloquent sluggable
}
