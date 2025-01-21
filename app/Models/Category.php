<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Category extends Model
{
    use HasSlug;
    protected $fillable = ['name', 'slug', 'status'];

    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id', 'id');
    }
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
    public function scopeCategoryActive($query)
    {
        $query->where('status', "active");
    }
}
