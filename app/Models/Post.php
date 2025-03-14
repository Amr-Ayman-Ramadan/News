<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model
{
    use HasSlug;
    protected $fillable = ["title","slug","description","comment_able","user_id","category_id", "status"];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }
    public function category()
    {
        return $this->belongsTo(Category::class, "category_id");
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, "post_id");
    }
    public function images()
    {
        return $this->hasMany(Image::class, "post_id");
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
    public function scopeActive($query)
    {
        $query->where("status", "active");
    }
}
