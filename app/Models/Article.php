<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Author;
use Illuminate\Database\Eloquent\Model;

// eloquent sluggable
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi dengan table categories (model: Category)
    public function category(){
        return $this->belongsTo(Category::class);
    }

    // Relasi dengan table article_user_links (model: ArticleUserLink)
    public function author(){
        return $this->hasMany(Author::class);
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
